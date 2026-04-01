<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

require_auth();

$flash = get_flash();
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chào Mừng</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="welcome-page">
    <main class="welcome-card">
        <?php if ($flash !== null): ?>
            <div class="alert <?= e($flash['type']) ?>">
                <?= e($flash['message']) ?>
            </div>
        <?php endif; ?>

        <p class="eyebrow">Xin chào</p>
        <h1>Chào mừng, <?= e((string) $user['username']) ?>!</h1>
        <p class="welcome-text">
            Bạn đã đăng nhập thành công và được chuyển hướng tới trang chức năng chính.
        </p>

        <div class="welcome-actions">
            <a class="secondary-button" href="index.php">Về trang đăng nhập</a>
            <a class="primary-button" href="logout.php">Đăng xuất</a>
        </div>
    </main>
</body>
</html>
