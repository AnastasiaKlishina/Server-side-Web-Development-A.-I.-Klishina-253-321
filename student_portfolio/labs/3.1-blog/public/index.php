<?php
declare(strict_types=1);
require_once __DIR__ . '/../app/Database.php';
require_once __DIR__ . '/../app/Controllers/ArticlesController.php';

try {
    $pdo = Database::connect();
    $controller = new ArticlesController($pdo);
    $action = $_GET['action'] ?? 'index';
    if ($action === 'show') {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id || $id < 1) {
            http_response_code(400);
            exit('Некорректный идентификатор статьи.');
        }
        $controller->show($id);
    } else {
        $controller->index();
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo '<h1>Не удалось подключиться к базе данных</h1>';
    echo '<p>Выберите базу miavertiko и импортируйте database.sql из папки проекта.</p>';
}
