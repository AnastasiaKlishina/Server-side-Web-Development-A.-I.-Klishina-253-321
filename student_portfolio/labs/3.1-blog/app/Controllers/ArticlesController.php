<?php
declare(strict_types=1);

final class ArticlesController
{
    public function __construct(private PDO $pdo) {}

    public function index(): void
    {
        $stmt = $this->pdo->query('SELECT id, title FROM articles ORDER BY id');
        $articles = $stmt->fetchAll();
        require __DIR__ . '/../../views/index.php';
    }

    public function show(int $id): void
    {
        // Первый запрос: получаем статью.
        $articleQuery = $this->pdo->prepare(
            'SELECT id, title, content, user_id FROM articles WHERE id = :id'
        );
        $articleQuery->execute([':id' => $id]);
        $article = $articleQuery->fetch();

        if (!$article) {
            http_response_code(404);
            $title = 'Статья не найдена';
            require __DIR__ . '/../../views/not-found.php';
            return;
        }

        // Второй запрос: получаем автора этой статьи из таблицы users.
        $authorQuery = $this->pdo->prepare(
            'SELECT nickname FROM users WHERE id = :user_id'
        );
        $authorQuery->execute([':user_id' => $article['user_id']]);
        $author = $authorQuery->fetch();

        $title = $article['title'];
        $nickname = $author['nickname'] ?? 'Автор не указан';
        require __DIR__ . '/../../views/show.php';
    }
}
