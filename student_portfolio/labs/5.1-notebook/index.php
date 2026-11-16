<?php
declare(strict_types=1);
session_start();
define('CONTACT_BOOK', true);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/menu.php';

$page = $_GET['page'] ?? 'view';
$allowed = ['view', 'add', 'edit', 'delete'];
if (!in_array($page, $allowed, true)) {
    $page = 'view';
}

$sort = $_GET['sort'] ?? 'created';
if (!in_array($sort, ['created', 'surname', 'birthdate'], true)) {
    $sort = 'created';
}
$pageNumber = filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT);
$pageNumber = ($pageNumber && $pageNumber > 0) ? $pageNumber : 1;

function e(?string $value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$csrf = $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Записная книжка контактов</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="top">
  <div class="brand"><span class="logo">К</span><div><strong>Контакты</strong><small>Личная записная книжка</small></div></div>
  <h1>Записная книжка</h1>
</header>
<nav class="nav"><?= get_menu() ?></nav>
<main class="container">
  <a class="back-home" href="/">← К списку лабораторных</a>
<?php
switch ($page) {
    case 'add':
        require __DIR__ . '/add.php';
        break;
    case 'edit':
        require __DIR__ . '/edit.php';
        break;
    case 'delete':
        require __DIR__ . '/delete.php';
        break;
    default:
        require __DIR__ . '/viewer.php';
        echo render_contacts($sort, $pageNumber);
        break;
}
?>
</main>
<footer>Записная книжка контактов</footer>
</body>
</html>
