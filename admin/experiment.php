<?php

declare(strict_types=1);

require __DIR__ . '/../includes/bootstrap.php';
require __DIR__ . '/../includes/layout.php';

require_admin();

$admin = current_user();

/** Display-only hygiene for note fields (see admin/experiments.php). */
function clean_display_value(string $value, int $max = 255): string
{
    $value = preg_replace('/[\x00-\x1F\x7F]+/', '', $value) ?? '';
    return mb_substr(trim($value), 0, $max);
}

// Resolve the target experiment from a verified database record, never trusting
// the raw id for anything beyond the lookup.
$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$experiment = find_experiment_by_id($id);

$errors = [];
$inviteError = null;

if ($experiment !== null && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_validate()) {
        http_response_code(400);
        $errors[] = 'Your session expired. Please try again.';
    } else {
        $action = (string) ($_POST['action'] ?? '');
        $now = gmdate('Y-m-d H:i:s');

        if ($action === 'update_metadata') {
            $code = clean_display_value((string) ($_POST['experiment_code'] ?? ''), 64);
            $name = clean_display_value((string) ($_POST['name'] ?? ''), 120);
            $slug = strtolower(clean_display_value((string) ($_POST['slug'] ?? ''), 80));
            $description = clean_display_value((string) ($_POST['description'] ?? ''), 500);
            $routePath = clean_display_value((string) ($_POST['route_path'] ?? ''));
            $visibility = (string) ($_POST['visibility'] ?? '');
            $status = (string) ($_POST['status'] ?? '');

            if ($code === '') {
                $errors['experiment_code'] = 'Enter an experiment code.';
            }
            if ($name === '') {
                $errors['name'] = 'Enter a name.';
            }
            if ($slug === '' || !preg_match('/^[a-z0-9][a-z0-9-]*$/', $slug)) {
                $errors['slug'] = 'Slug must be lowercase letters, numbers, and hyphens.';
            }
            if (!is_valid_experiment_visibility($visibility)) {
                $errors['visibility'] = 'Invalid visibility.';
            }
            if (!is_valid_experiment_status($status)) {
                $errors['status'] = 'Invalid status.';
            }

            if ($errors === []) {
                $publishedAt = $experiment['published_at'];
                if ($visibility === 'public' && $publishedAt === null) {
                    $publishedAt = $now;
                }
                try {
                    $stmt = db()->prepare(
                        'UPDATE experiments
                            SET experiment_code = :code, slug = :slug, name = :name,
                                description = :desc, route_path = :route, visibility = :vis,
                                status = :status, published_at = :pub, updated_at = :now
                          WHERE id = :id'
                    );
                    $stmt->execute([
                        ':code'   => $code,
                        ':slug'   => $slug,
                        ':name'   => $name,
                        ':desc'   => $description,
                        ':route'  => $routePath !== '' ? $routePath : null,
                        ':vis'    => $visibility,
                        ':status' => $status,
                        ':pub'    => $publishedAt,
                        ':now'    => $now,
                        ':id'     => (int) $experiment['id'],
                    ]);
                    $_SESSION['flash'] = 'Experiment updated.';
                    redirect(url('admin/experiment.php?id=' . (int) $experiment['id']));
                } catch (PDOException $ex) {
                    if ($ex->getCode() === '23000') {
                        $errors[] = 'That experiment code or slug is already in use.';
                    } else {
                        $errors[] = 'Unable to update the experiment. Please try again.';
                    }
                }
            }
        } elseif ($action === 'add_invite') {
            $email = strtolower(trim((string) ($_POST['email'] ?? '')));
            $stmt = db()->prepare('SELECT id FROM users WHERE email = :email');
            $stmt->execute([':email' => $email]);
            $userRow = $stmt->fetch();
            if ($userRow === false) {
                // No such registered user: change nothing, create nothing, send nothing.
                $inviteError = 'No registered user matches that email address.';
            } else {
                $created = invite_user_to_experiment((int) $experiment['id'], (int) $userRow['id'], (int) $admin['id']);
                $_SESSION['flash'] = $created ? 'Invite added.' : 'That user is already invited.';
                redirect(url('admin/experiment.php?id=' . (int) $experiment['id']));
            }
        } elseif ($action === 'remove_invite') {
            $userId = (int) ($_POST['user_id'] ?? 0);
            remove_experiment_invite((int) $experiment['id'], $userId);
            $_SESSION['flash'] = 'Invite removed.';
            redirect(url('admin/experiment.php?id=' . (int) $experiment['id']));
        }
    }
}

// A missing experiment gets the generic admin 404 (this is an admin tool, so a
// real 404 is appropriate here; the privacy gate for public routes is separate).
if ($experiment === null) {
    render_not_found();
}

// Reload after any in-request edits so the form shows current values.
$experiment = find_experiment_by_id((int) $experiment['id']) ?? $experiment;
$invites = list_experiment_invites((int) $experiment['id']);

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

render_page_top('Manage experiment', 'admin');
?>
<section class="auth-card auth-card--wide" aria-labelledby="exp-title">
    <p class="mono">Admin console · Manage experiment</p>
    <h1 id="exp-title"><?= e($experiment['name']) ?></h1>
    <p><a class="btn btn--quiet" href="<?= e(url('admin/experiments.php')) ?>">← Registry</a></p>

    <?php if ($flash !== null): ?>
        <p class="flash" role="status"><?= e($flash) ?></p>
    <?php endif; ?>

    <?php render_error_summary(array_values($errors)); ?>

    <h2 class="admin-subhead">Metadata</h2>
    <form method="post" action="<?= e(url('admin/experiment.php?id=' . (int) $experiment['id'])) ?>" class="auth-form" novalidate>
        <?= csrf_field() ?>
        <input type="hidden" name="action" value="update_metadata">
        <input type="hidden" name="id" value="<?= e((string) $experiment['id']) ?>">

        <div class="field<?= isset($errors['experiment_code']) ? ' field--error' : '' ?>">
            <label for="experiment_code">Experiment code</label>
            <input type="text" id="experiment_code" name="experiment_code" value="<?= e($experiment['experiment_code']) ?>" required>
            <?php if (isset($errors['experiment_code'])): ?><p class="field__error"><?= e($errors['experiment_code']) ?></p><?php endif; ?>
        </div>
        <div class="field<?= isset($errors['name']) ? ' field--error' : '' ?>">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= e($experiment['name']) ?>" required>
            <?php if (isset($errors['name'])): ?><p class="field__error"><?= e($errors['name']) ?></p><?php endif; ?>
        </div>
        <div class="field<?= isset($errors['slug']) ? ' field--error' : '' ?>">
            <label for="slug">Slug</label>
            <input type="text" id="slug" name="slug" value="<?= e($experiment['slug']) ?>" required>
            <?php if (isset($errors['slug'])): ?><p class="field__error"><?= e($errors['slug']) ?></p><?php endif; ?>
        </div>
        <div class="field">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="<?= e($experiment['description']) ?>">
        </div>
        <div class="field">
            <label for="route_path">Route path <span class="field__hint">(display-only note)</span></label>
            <input type="text" id="route_path" name="route_path" value="<?= e((string) ($experiment['route_path'] ?? '')) ?>">
        </div>
        <div class="field<?= isset($errors['visibility']) ? ' field--error' : '' ?>">
            <label for="visibility">Visibility</label>
            <select id="visibility" name="visibility">
                <?php foreach (EXPERIMENT_VISIBILITIES as $v): ?>
                    <option value="<?= e($v) ?>"<?= $experiment['visibility'] === $v ? ' selected' : '' ?>><?= e($v) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="field<?= isset($errors['status']) ? ' field--error' : '' ?>">
            <label for="status">Status</label>
            <select id="status" name="status">
                <?php foreach (EXPERIMENT_STATUSES as $s): ?>
                    <option value="<?= e($s) ?>"<?= $experiment['status'] === $s ? ' selected' : '' ?>><?= e($s) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <p class="auth-note">
            Published at: <?= e((string) ($experiment['published_at'] ?? '—')) ?> ·
            Created: <?= e($experiment['created_at']) ?> UTC
        </p>
        <button type="submit" class="btn btn--primary">Save changes</button>
    </form>

    <h2 class="admin-subhead">Invited testers</h2>
    <p class="auth-note">
        Invitations only grant access while visibility is <strong>invite</strong>.
        They apply to existing registered users only.
    </p>

    <?php if ($inviteError !== null): ?>
        <p class="field__error" role="alert"><?= e($inviteError) ?></p>
    <?php endif; ?>

    <?php if ($invites === []): ?>
        <p class="auth-note">No testers invited yet.</p>
    <?php else: ?>
        <div class="table-scroll">
            <table class="registry">
                <thead>
                    <tr><th scope="col">Name</th><th scope="col">Email</th><th scope="col">Invited</th><th scope="col"></th></tr>
                </thead>
                <tbody>
                    <?php foreach ($invites as $inv): ?>
                        <tr>
                            <td><?= e($inv['name']) ?></td>
                            <td><?= e($inv['email']) ?></td>
                            <td><?= e($inv['created_at']) ?></td>
                            <td>
                                <form method="post" action="<?= e(url('admin/experiment.php?id=' . (int) $experiment['id'])) ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="action" value="remove_invite">
                                    <input type="hidden" name="id" value="<?= e((string) $experiment['id']) ?>">
                                    <input type="hidden" name="user_id" value="<?= e((string) $inv['id']) ?>">
                                    <button type="submit" class="btn btn--quiet">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= e(url('admin/experiment.php?id=' . (int) $experiment['id'])) ?>" class="auth-form" novalidate>
        <?= csrf_field() ?>
        <input type="hidden" name="action" value="add_invite">
        <input type="hidden" name="id" value="<?= e((string) $experiment['id']) ?>">
        <div class="field">
            <label for="invite-email">Invite a registered user by email</label>
            <input type="email" id="invite-email" name="email" autocomplete="off" required>
        </div>
        <button type="submit" class="btn btn--ghost">Add invite</button>
    </form>
</section>
<?php
render_page_bottom();
