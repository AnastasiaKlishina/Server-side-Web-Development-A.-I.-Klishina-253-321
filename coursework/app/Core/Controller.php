<?php
declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $viewFile = dirname(__DIR__, 2) . '/views/' . $view . '.php';
        if (!is_file($viewFile)) {
            http_response_code(500);
            echo 'Шаблон страницы не найден.';
            return;
        }
        require dirname(__DIR__, 2) . '/views/layout.php';
    }

    protected function redirect(string $route): never
    {
        header('Location: index.php?route=' . rawurlencode($route));
        exit;
    }

    protected function requirePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Метод не поддерживается.');
        }
        $token = (string)($_POST['_token'] ?? '');
        if (!hash_equals($_SESSION['_token'] ?? '', $token)) {
            http_response_code(419);
            exit('Срок действия формы истёк. Обновите страницу и повторите попытку.');
        }
    }
}
