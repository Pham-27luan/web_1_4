<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

require_guest();

$flash = get_flash();
$old = get_old();
$username = $old['username'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
    <div class="bg-shape shape-one"></div>
    <div class="bg-shape shape-two"></div>

    <main class="auth-layout">
        <section class="card-panel auth-card">
            <div class="card-header">
                <h2>Đăng Nhập</h2>
                <p>Nhập tên người dùng và mật khẩu để tiếp tục.</p>
            </div>

            <?php if ($flash !== null): ?>
                <div class="alert <?= e($flash['type']) ?>">
                    <?= e($flash['message']) ?>
                </div>
            <?php endif; ?>

            <form class="auth-form" action="process_login.php" method="POST">
                <label for="username">Tên người dùng</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Nhập username"
                    value="<?= e((string) $username) ?>"
                    required
                >

                <label for="password">Mật khẩu</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Nhập mật khẩu"
                    required
                >

                <button type="submit">Đăng nhập</button>
            </form>

            <p class="switch-text">
                Chưa có tài khoản?
                <a href="register.php">Đăng ký ngay</a>
            </p>
        </section>
    </main>
</body>
</html>
