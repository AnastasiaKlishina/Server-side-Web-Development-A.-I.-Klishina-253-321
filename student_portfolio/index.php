<?php
declare(strict_types=1);
$title = 'Мои лабораторные работы';
$sections = [
    [
        'number' => '4.1',
        'name' => 'Домашняя работа: Feedback Form',
        'description' => 'Двухстраничная форма обратной связи с отправкой на httpbin.org/post и выводом заголовков через get_headers().',
        'url' => 'labs/4.1-feedback-form/',
        'tag' => 'HTML · CSS · PHP',
    ],
    [
        'number' => '5.1',
        'name' => 'Домашняя работа: Notebook',
        'description' => 'Записная книжка контактов: просмотр, добавление, редактирование, удаление и сортировка записей.',
        'url' => 'labs/5.1-notebook/',
        'tag' => 'PHP · MySQL · PDO',
    ],
    [
        'number' => '2.1',
        'name' => 'Домашняя работа с роутингом',
        'description' => 'Добавление действия sayBye(string $name) и маршрута /bye/$name с выводом «Пока, $name».',
        'url' => 'labs/2.1-2.2-controller/public/bye/Аня',
        'tag' => 'PHP · Routing',
    ],
    [
        'number' => '2.2',
        'name' => 'Домашняя работа с представлением',
        'description' => 'Передача title в шаблон через переменную, заголовок по умолчанию «Мой блог» и title «Страница приветствия» для /hello/username.',
        'url' => 'labs/2.1-2.2-controller/public/hello/Аня',
        'tag' => 'PHP · Views',
    ],
    [
        'number' => '3.1',
        'name' => 'Домашняя работа: ArticlesController',
        'description' => 'После получения статьи выполняется отдельный запрос к таблице users; nickname автора выводится в шаблоне.',
        'url' => 'labs/3.1-blog/public/',
        'tag' => 'PHP · MySQL · SQL',
    ],
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="assets/main.css">
</head>
<body>
<header class="hero">
    <div class="hero-inner">
        <div class="eyebrow">УЧЕБНОЕ ПОРТФОЛИО</div>
        <h1>Мои лабораторные работы</h1>
        <p>Учебные проекты по PHP, HTML, CSS и работе с базами данных.</p>
        <div class="student-name">Клишина А.И. <span>·</span> группа 253-321</div>
    </div>
</header>
<main class="container">
    <div class="section-heading">
        <div><span class="eyebrow">МОИ ПРОЕКТЫ</span><h2>Список работ</h2></div>
        <span class="counter"><?= count($sections) ?> работ</span>
    </div>
    <div class="cards">
        <?php foreach ($sections as $section): ?>
            <article class="card">
                <div class="card-top">
                    <span class="number"><?= htmlspecialchars($section['number']) ?></span>
                    <span class="tag"><?= htmlspecialchars($section['tag']) ?></span>
                </div>
                <h3><?= htmlspecialchars($section['name']) ?></h3>
                <p><?= htmlspecialchars($section['description']) ?></p>
                <a class="open-link" href="<?= htmlspecialchars($section['url']) ?>">Открыть работу <span>→</span></a>
            </article>
        <?php endforeach; ?>
    </div>
</main>
<footer>Учебное портфолио · PHP / XAMPP</footer>
</body>
</html>
