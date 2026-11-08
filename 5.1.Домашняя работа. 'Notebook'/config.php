<?php
if (!defined('CONTACT_BOOK')) {
    http_response_code(403);
    exit('Доступ запрещён');
}

/*
 * Укажите параметры MySQL вашего хостинга.
 * Создайте базу данных и импортируйте schema.sql.
 */
$dbHost = 'localhost';
$dbName = 'contact_book';
$dbUser = 'root';
$dbPass = '';

try {
    $pdo = new PDO(
        "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $exception) {
    http_response_code(500);
    exit('Не удалось подключиться к базе данных. Проверьте настройки в config.php и импорт schema.sql.');
}
