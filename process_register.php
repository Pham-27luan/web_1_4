<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('register.php');
}

$username = trim((string) ($_POST['username'] ?? ''));
$password = (string) ($_POST['password'] ?? '');
$confirmPassword = (string) ($_POST['confirm_password'] ?? '');

set_old(['username' => $username]);

if ($username === '' || $password === '' || $confirmPassword === '') {
    set_flash('error', 'Vui lòng điền đầy đủ thông tin đăng ký.');
    redirect('register.php');
}

if (!preg_match('/^[A-Za-z0-9_.]{3,50}$/', $username)) {
    set_flash('error', 'Tên người dùng phải dài 3-50 ký tự và chỉ gồm chữ, số, dấu gạch dưới hoặc dấu chấm.');
    redirect('register.php');
}

if (strlen($password) < 6) {
    set_flash('error', 'Mật khẩu phải có ít nhất 6 ký tự.');
    redirect('register.php');
}

if ($password !== $confirmPassword) {
    set_flash('error', 'Mật khẩu xác nhận không khớp.');
    redirect('register.php');
}

$checkUser = db()->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
$checkUser->execute(['username' => $username]);

if ($checkUser->fetch() !== false) {
    set_flash('error', 'Tên người dùng đã tồn tại, vui lòng chọn tên khác.');
    redirect('register.php');
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

if ($passwordHash === false) {
    set_flash('error', 'Không thể bảo mật mật khẩu. Vui lòng thử lại.');
    redirect('register.php');
}

$insertUser = db()->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
$insertUser->execute([
    'username' => $username,
    'password' => $passwordHash,
]);

unset($_SESSION['old_input']);
set_flash('success', 'Đăng ký thành công! Hãy đăng nhập để tiếp tục.');

redirect('index.php');
