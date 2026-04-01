<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}

$username = trim((string) ($_POST['username'] ?? ''));
$password = (string) ($_POST['password'] ?? '');

set_old(['username' => $username]);

if ($username === '' || $password === '') {
    set_flash('error', 'Vui lòng nhập đầy đủ tên người dùng và mật khẩu.');
    redirect('index.php');
}

$statement = db()->prepare('SELECT id, username, password FROM users WHERE username = :username LIMIT 1');
$statement->execute(['username' => $username]);
$user = $statement->fetch();

if ($user === false || !password_verify($password, $user['password'])) {
    set_flash('error', 'Đăng nhập thất bại!');
    redirect('index.php');
}

session_regenerate_id(true);

$_SESSION['user'] = [
    'id' => (int) $user['id'],
    'username' => $user['username'],
];

unset($_SESSION['old_input']);
set_flash('success', 'Đăng nhập thành công!');

redirect('welcome.php');
