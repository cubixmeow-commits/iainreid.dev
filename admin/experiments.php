<?php

declare(strict_types=1);

require __DIR__ . '/../includes/bootstrap.php';
require __DIR__ . '/../includes/layout.php';

// Re-check admin authorization server-side on every request.
require_admin();

$admin = current_user();
$errors = [];
$create = ['experiment_code' => '', 'name' => '', 'slug' => '', 'description' => '', 'route_path' => '', 'visibility' => 'private', 'status' => 'framing'];

/**
 * Trim a display-only value: strip control characters and cap length. route_path
 * is never routed/included/redirected, so no path-safety validation is needed
 * beyond this display hygiene.
 */
function clean_display_value(string $value, int $max = 255): string
{
    $value = preg_replace('/[\x00-\x1F\x7F]+/', '', $value) ?? '';
    return mb_substr(trim($value), 0, $max);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_validate()) {
        http_response_code(400);
        $errors[] = 'Your session expired. Please try again.';
    } else {
        $action = (string) ($_POST['action'] ?? '');

        if ($action === 'create') {
            $create['experiment_code'] = clean_display_value((string) ($_POST['experiment_code'] ?? ''), 64);
            $create['name'] = clean_display_value((string) ($_POST['name'] ?? ''), 120);
            $create['slug'] = strtolower(clean_display_value((string) ($_POST['slug'] ?? ''), 80));
            $create['description'] = clean_display_value((string) ($_POST['description'] ?? ''), 500);
            $create['route_path'] = clean_display_value((string) ($_POST['route_path'] ?? ''));
            $create['visibility'] = (string) ($_POST['visibility'] ?? 'private');
            $create['status'] = (string) ($_POST['status'] ?? 'framing');

            if ($create['experiment_code'] === '') {
                $errors['experiment_code'] = 'Enter an experiment code.';
            }
            if ($create['name'] === '') {
                $errors['name'] = 'Enter a name.';
            }
            if ($create['slug'] === '' || !preg_match('/^[a-z0-9][a-z0-9-]*$/', $create['slug'])) {
                $errors['slug'] = 'Slug must be lowercase letters, numbers, and hyphens.';
            }
            if (!is_valid_experiment_visibility($create['visibility'])) {
                $errors['visibility'] = 'Invalid visibility.';
            }
            if (!is_valid_experiment_status($create['status'])) {
                $errors['status'] = 'Invalid status.';
            }

            if ($errors === []) {
                $now = gmdate('Y-m-d H:i:s');
                $publishedAt = $create['visibility'] === 'public' ? $now : null;
                try {
                    $stmt = db()->prepare(
                        'INSERT INTO experiments
                            (experiment_code, slug, name, description, visibility, route_path, status, created_by, created_at, updated_at, published_at)
                         VALUES (:code, :slug, :name, :desc, :vis, :route, :status, :by, :created, :updated, :published)'
                    );
                    $stmt->execute([
                        ':code'      => $create['experiment_code'],
                        ':slug'      => $create['slug'],
                        ':name'      => $create['name'],
                        ':desc'      => $create['description'],
                        ':vis'       => $create['visibility'],
                        ':route'     => $create['route_path'] !== '' ? $create['route_path'] : null,
                        ':status'    => $create['status'],
                        ':by'        => (int) $admin['id'],
                        ':created'   => $now,
                        ':updated'   => $now,
                        ':published' => $publishedAt,
                    ]);
                    $_SESSION['flash'] = 'Experiment "' . $create['slug'] . '" created.';
                    redirect(url('admin/experiments.php'));
                } catch (PDOException $ex) {
                    if ($ex->getCode() === '23000') {
                        $errors[] = 'That experiment code or slug is already in use.';
                    } else {
                        $errors[] = 'Unable to create the experiment. Please try again.';
                    }
                }
            }
        } elseif ($action === 'set_visibility' || $action === 'set_status') {
            $id = (int) ($_POST['id'] ?? 0);
            $experiment = find_experiment_by_id($id);
            if ($experiment === null) {
                $errors[] = 'That experiment no longer exists.';
            } else {
                $now = gmdate('Y-m-d H:i:s');
                if ($action === 'set_visibility') {
                    $vis = (string) ($_POST['visibility'] ?? '');
                    if (!is_valid_experiment_visibility($vis)) {
                        $errors[] = 'Invalid visibility value.';
                    } else {
                        // Set published_at the first time it becomes public; keep
                        // it when moving back to private/invite.
                        $publishedAt = $experiment['published_at'];
                        if ($vis === 'public' && $publishedAt === null) {
                            $publishedAt = $now;
                        }
                        $stmt = db()->prepare(
                            'UPDATE experiments SET visibility = :vis, published_at = :pub, updated_at = :now WHERE id = :id'
                        );
                        $stmt->execute([':vis' => $vis, ':pub' => $publishedAt, ':now' => $now, ':id' => $id]);
                        $_SESSION['flash'] = 'Visibility updated for "' . $experiment['slug'] . '".';
                        redirect(url('admin/experiments.php'));
                    }
                } else {
                    $status = (string) ($_POST['status'] ?? '');
                    if (!is_valid_experiment_status($status)) {
                        $errors[] = 'Invalid status value.';
                    } else {
                        $stmt = db()->prepare('UPDATE experiments SET status = :status, updated_at = :now WHERE id = :id');
                        $stmt->execute([':status' => $status, ':now' => $now, ':id' => $id]);
                        $_SESSION['flash'] = 'Status updated for "' . $experiment['slug'] . '".';
                        redirect(url('admin/experiments.php'));
                    }
                }
            }
        }
    }
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$experiments = db()->query('SELECT * FROM experiments ORDER BY created_at DESC, id DESC')->fetchAll();
$inviteCounts = experiment_invite_counts();

render_page_top('Experiment registry', 'admin');
?>
<section class="auth-card auth-card--wide" aria-labelledby="reg-title">
    <p class="mono">Admin console · Experiment registry</p>
    <h1 id="reg-title">Experiment registry</h1>
    <p><a class="btn btn--quiet" href="<?= e(url('admin/')) ?>">← Admin console</a></p>

    <?php if ($flash !== null): ?>
        <p class="flash" role="status"><?= e($flash) ?></p>
    <?php endif; ?>

    <?php render_error_summary(array_values($errors)); ?>

    <h2 class="admin-subhead">Experiments</h2>
    <?php if ($experiments === []): ?>
        <p class="auth-note">No experiments registered yet.</p>
    <?php else: ?>
        <div class="table-scroll">
            <table class="registry">
                <thead>
                    <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Route (note)</th>
                        <th scope="col">Visibility</th>
                        <th scope="col">Status</th>
                        <th scope="col">Invites</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($experiments as $exp): ?>
                        <tr>
                            <td><?= e($exp['experiment_code']) ?></td>
                            <td><?= e($exp['name']) ?></td>
                            <td><?= e($exp['slug']) ?></td>
                            <td><?= e((string) ($exp['route_path'] ?? '—')) ?></td>
                            <td>
                                <form method="post" class="inline-select">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="action" value="set_visibility">
                                    <input type="hidden" name="id" value="<?= e((string) $exp['id']) ?>">
                                    <label class="sr-only" for="vis-<?= e((string) $exp['id']) ?>">Visibility</label>
                                    <select id="vis-<?= e((string) $exp['id']) ?>" name="visibility" onchange="this.form.submit()">
                                        <?php foreach (EXPERIMENT_VISIBILITIES as $v): ?>
                                            <option value="<?= e($v) ?>"<?= $exp['visibility'] === $v ? ' selected' : '' ?>><?= e($v) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <noscript><button type="submit">Set</button></noscript>
                                </form>
                            </td>
                            <td>
                                <form method="post" class="inline-select">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="action" value="set_status">
                                    <input type="hidden" name="id" value="<?= e((string) $exp['id']) ?>">
                                    <label class="sr-only" for="st-<?= e((string) $exp['id']) ?>">Status</label>
                                    <select id="st-<?= e((string) $exp['id']) ?>" name="status" onchange="this.form.submit()">
                                        <?php foreach (EXPERIMENT_STATUSES as $s): ?>
                                            <option value="<?= e($s) ?>"<?= $exp['status'] === $s ? ' selected' : '' ?>><?= e($s) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <noscript><button type="submit">Set</button></noscript>
                                </form>
                            </td>
                            <td><?= e((string) ($inviteCounts[(int) $exp['id']] ?? 0)) ?></td>
                            <td><?= e($exp['updated_at']) ?></td>
                            <td><a href="<?= e(url('admin/experiment.php?id=' . (int) $exp['id'])) ?>">Manage</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <h2 class="admin-subhead">Register a new experiment</h2>
    <form method="post" action="<?= e(url('admin/experiments.php')) ?>" class="auth-form" novalidate>
        <?= csrf_field() ?>
        <input type="hidden" name="action" value="create">

        <div class="field<?= isset($errors['experiment_code']) ? ' field--error' : '' ?>">
            <label for="experiment_code">Experiment code</label>
            <input type="text" id="experiment_code" name="experiment_code" value="<?= e($create['experiment_code']) ?>" required>
            <?php if (isset($errors['experiment_code'])): ?><p class="field__error"><?= e($errors['experiment_code']) ?></p><?php endif; ?>
        </div>

        <div class="field<?= isset($errors['name']) ? ' field--error' : '' ?>">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= e($create['name']) ?>" required>
            <?php if (isset($errors['name'])): ?><p class="field__error"><?= e($errors['name']) ?></p><?php endif; ?>
        </div>

        <div class="field<?= isset($errors['slug']) ? ' field--error' : '' ?>">
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug" value="<?= e($create['slug']) ?>" required>
            <p class="field__hint">Lowercase letters, numbers, hyphens. Used by the page gate.</p>
            <?php if (isset($errors['slug'])): ?><p class="field__error"><?= e($errors['slug']) ?></p><?php endif; ?>
        </div>

        <div class="field">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="<?= e($create['description']) ?>">
        </div>

        <div class="field">
            <label for="route_path">Route path <span class="field__hint">(display-only note; never used for routing)</span></label>
            <input type="text" id="route_path" name="route_path" value="<?= e($create['route_path']) ?>">
        </div>

        <div class="field<?= isset($errors['visibility']) ? ' field--error' : '' ?>">
            <label for="c-visibility">Visibility</label>
            <select id="c-visibility" name="visibility">
                <?php foreach (EXPERIMENT_VISIBILITIES as $v): ?>
                    <option value="<?= e($v) ?>"<?= $create['visibility'] === $v ? ' selected' : '' ?>><?= e($v) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="field<?= isset($errors['status']) ? ' field--error' : '' ?>">
            <label for="c-status">Status</label>
            <select id="c-status" name="status">
                <?php foreach (EXPERIMENT_STATUSES as $s): ?>
                    <option value="<?= e($s) ?>"<?= $create['status'] === $s ? ' selected' : '' ?>><?= e($s) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn--primary">Create experiment</button>
    </form>
</section>
<?php
render_page_bottom();
