<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;

final class ArticleController extends Controller
{
    public function index(): void
    {
        $this->render('articles/index', ['title'=>'Полезные материалы', 'articles'=>(new Article())->latest()]);
    }

    public function show(): void
    {
        $article = (new Article())->find((int)($_GET['id'] ?? 0));
        if (!$article) {
            http_response_code(404);
            $this->render('errors/404', ['title'=>'Материал не найден']);
            return;
        }
        $this->render('articles/show', ['title'=>$article['title'], 'article'=>$article]);
    }

    public function save(): void
    {
        $this->requirePost();
        $title = trim((string)($_POST['title'] ?? ''));
        $content = trim((string)($_POST['content'] ?? ''));
        if ($title === '' || $content === '') {
            $_SESSION['flash_error'] = 'Заполните заголовок и текст материала.';
            $this->redirect('articles');
        }
        (new Article())->create([
            'title'=>$title,
            'category'=>trim((string)($_POST['category'] ?? 'Общее')),
            'excerpt'=>mb_substr($content, 0, 180),
            'content'=>$content,
        ]);
        $_SESSION['flash_success'] = 'Материал опубликован.';
        $this->redirect('articles');
    }

    public function delete(): void
    {
        $this->requirePost();
        (new Article())->delete((int)($_POST['id'] ?? 0));
        $_SESSION['flash_success'] = 'Материал удалён.';
        $this->redirect('articles');
    }
}
