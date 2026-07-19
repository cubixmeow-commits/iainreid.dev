<?php
declare(strict_types=1);

$phpVersion = PHP_VERSION;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iainreid.dev</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main>
        <h1>iainreid.dev</h1>
        <p>Portfolio rebuild in progress</p>
        <p class="php-ok">PHP is working (<?php echo htmlspecialchars($phpVersion, ENT_QUOTES, 'UTF-8'); ?>)</p>
    </main>
    <script src="/assets/js/app.js"></script>
</body>
</html>
