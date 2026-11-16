<?php
$title = $title ?? 'Мой блог';
$content = $content ?? '';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></title>
    <style>
        .back-home { display:inline-block; margin-bottom:18px; padding:9px 13px; border:1px solid #cbd7e5; border-radius:7px; background:#f7faff; color:#245b96; text-decoration:none; font-size:14px; font-weight:bold; }
        body { font-family: Arial, sans-serif; max-width: 760px; margin: 60px auto; padding: 0 20px; color: #202a35; }
        main { padding: 28px; border: 1px solid #d8e1e9; border-radius: 12px; background: #f8fafc; }
        h1 { margin-top: 0; color: #1769aa; }
        a { color: #1769aa; }
    </style>
</head>
<body>
<main>
    <a class="back-home" href="/">← К списку лабораторных</a>
    <h1><?= htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></h1>
    <p><?= htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
    <p><a href="/labs/2.1-2.2-controller/public/">Вернуться к заданию</a></p>
</main>
</body>
</html>
