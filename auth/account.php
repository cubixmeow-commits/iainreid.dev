<?php

declare(strict_types=1);

require __DIR__ . '/../includes/bootstrap.php';
require __DIR__ . '/../includes/layout.php';

require_login();

$user = current_user();

render_page_top('Your account', 'account');
?>
<section class="auth-card" aria-labelledby="account-title">
    <p class="mono">Lab Access · Account record</p>
    <h1 id="account-title">Your SaaS Lab account</h1>

    <dl class="record">
        <div class="record__row">
            <dt>Name</dt>
            <dd><?= e($user['name']) ?></dd>
        </div>
        <div class="record__row">
            <dt>Email</dt>
            <dd><?= e($user['email']) ?></dd>
        </div>
        <div class="record__row">
            <dt>Role</dt>
            <dd><span class="tag tag--<?= e($user['role']) ?>"><?= e($user['role']) ?></span></dd>
        </div>
        <div class="record__row">
            <dt>Account created</dt>
            <dd><?= e($user['created_at']) ?> UTC</dd>
        </div>
    </dl>

    <p class="auth-note">
        This account will eventually provide shared access to the SaaS Lab
        experiments as they come online. For now it simply establishes your
        identity in the lab.
    </p>

    <?php if (is_admin()): ?>
        <p><a class="btn btn--ghost" href="<?= e(url('admin/')) ?>">Open admin console</a></p>
    <?php endif; ?>

    <form method="post" action="<?= e(url('auth/logout.php')) ?>" class="auth-form auth-form--inline">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn--quiet">Log out</button>
    </form>
</section>
<?php
render_page_bottom();
