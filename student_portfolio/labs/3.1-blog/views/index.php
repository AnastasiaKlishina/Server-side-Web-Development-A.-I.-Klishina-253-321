<!DOCTYPE html>
<html lang="ru"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Мой блог</title><link rel="stylesheet" href="style.css"></head>
<body><main class="panel"><a class="back-home" href="/student_portfolio/">← К списку лабораторных</a><a href="../../">← Все лабораторные</a><h1>Мой блог</h1><h2>Статьи</h2>
<?php if (!$articles): ?><p>Статей пока нет. Импортируйте database.sql.</p><?php else: ?>
<ul><?php foreach ($articles as $item): ?><li><a href="index.php?action=show&id=<?= (int)$item['id'] ?>"><?= htmlspecialchars($item['title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></a></li><?php endforeach; ?></ul>
<?php endif; ?></main></body></html>
