<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

unset($_SESSION['user']);
session_regenerate_id(true);

set_flash('success', 'Bạn đã đăng xuất thành công.');
redirect('index.php');
