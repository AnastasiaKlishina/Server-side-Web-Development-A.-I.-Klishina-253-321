<?php
declare(strict_types=1);
require_once __DIR__ . '/../app/Controllers/GreetingController.php';
use App\Controllers\GreetingController;

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$basePath = '/labs/2.1-2.2-controller/public';
if (str_starts_with($path, $basePath)) {
    $path = substr($path, strlen($basePath));
}
$path = '/' . trim($path, '/');

$controller = new GreetingController();
$title = 'Мой блог';
$content = 'Выберите маршрут: /hello/Аня или /bye/Аня.';

if (preg_match('~^/hello/([^/]+)/?$~u', $path, $m)) {
    $title = 'Страница приветствия';
    $content = $controller->sayHello(rawurldecode($m[1]));
} elseif (preg_match('~^/bye/([^/]+)/?$~u', $path, $m)) {
    $content = $controller->sayBye(rawurldecode($m[1]));
} elseif ($path !== '/') {
    http_response_code(404);
    $content = 'Страница не найдена.';
}
require __DIR__ . '/../views/layout.php';
