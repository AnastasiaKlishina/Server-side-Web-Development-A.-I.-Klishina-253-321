<?php
declare(strict_types=1);

use App\Controllers\DashboardController;
use App\Controllers\TaskController;
use App\Controllers\GradeController;
use App\Controllers\ArticleController;
use App\Controllers\FeedbackController;
use App\Controllers\CalculatorController;
use App\Controllers\StatsController;

session_start();
if (empty($_SESSION['_token'])) {
    $_SESSION['_token'] = bin2hex(random_bytes(32));
}

define('BASE_PATH', dirname(__DIR__));
spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) return;
    $relative = str_replace('\\', '/', substr($class, strlen($prefix)));
    $file = BASE_PATH . '/app/' . $relative . '.php';
    if (is_file($file)) require $file;
});

function e(mixed $value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$route = (string)($_GET['route'] ?? 'dashboard');
$routes = [
    'dashboard' => [DashboardController::class, 'index'],
    'tasks' => [TaskController::class, 'index'],
    'task-form' => [TaskController::class, 'editForm'],
    'task-save' => [TaskController::class, 'save'],
    'task-delete' => [TaskController::class, 'delete'],
    'grades' => [GradeController::class, 'index'],
    'grade-save' => [GradeController::class, 'save'],
    'grade-delete' => [GradeController::class, 'delete'],
    'articles' => [ArticleController::class, 'index'],
    'article' => [ArticleController::class, 'show'],
    'article-save' => [ArticleController::class, 'save'],
    'article-delete' => [ArticleController::class, 'delete'],
    'feedback' => [FeedbackController::class, 'index'],
    'feedback-send' => [FeedbackController::class, 'send'],
    'calculator' => [CalculatorController::class, 'index'],
    'messages' => [StatsController::class, 'index'],
];

try {
    if (!isset($routes[$route])) {
        http_response_code(404);
        $controller = new DashboardController();
        $controller->index();
        exit;
    }
    [$class, $method] = $routes[$route];
    (new $class())->$method();
} catch (Throwable $exception) {
    http_response_code(500);
    $message = $exception->getMessage();
    if (str_contains($message, 'PostgreSQL') || str_contains($message, 'подключиться')) {
        $safeMessage = $message;
    } else {
        error_log((string)$exception);
        $safeMessage = 'Произошла внутренняя ошибка. Проверьте журнал ошибок PHP.';
    }
    require BASE_PATH . '/views/errors/500.php';
}
