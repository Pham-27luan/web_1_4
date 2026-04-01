<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function get_flash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function set_old(array $data): void
{
    $_SESSION['old_input'] = $data;
}

function get_old(): array
{
    $old = $_SESSION['old_input'] ?? [];
    unset($_SESSION['old_input']);

    return is_array($old) ? $old : [];
}

function is_logged_in(): bool
{
    return isset($_SESSION['user']);
}

function require_guest(): void
{
    if (is_logged_in()) {
        redirect('welcome.php');
    }
}

function require_auth(): void
{
    if (!is_logged_in()) {
        set_flash('error', 'Vui lòng đăng nhập để tiếp tục.');
        redirect('index.php');
    }
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
