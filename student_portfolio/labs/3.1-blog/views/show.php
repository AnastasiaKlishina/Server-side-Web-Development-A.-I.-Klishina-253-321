<!DOCTYPE html>
<html lang="ru"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?= htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></title><link rel="stylesheet" href="/labs/3.1-blog/public/style.css"></head>
<body><main class="panel"><a class="back-home" href="/">← К списку лабораторных</a><a href="index.php">← Все статьи</a>
<h1><?= htmlspecialchars($article['title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></h1>
<p class="content"><?= nl2br(htmlspecialchars($article['content'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
<p class="author">Автор: <strong><?= htmlspecialchars($nickname, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></strong></p>
</main></body></html>
