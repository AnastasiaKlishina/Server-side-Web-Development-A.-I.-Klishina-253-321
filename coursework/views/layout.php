<?php
$flashSuccess = $_SESSION['flash_success'] ?? null;
$flashError = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);
$active = (string)($_GET['route'] ?? 'dashboard');
$nav = [
    'dashboard' => ['Главная панель', '⌂'],
    'tasks' => ['Учебные задачи', '✓'],
    'grades' => ['Успеваемость', '▥'],
    'calculator' => ['Калькулятор оценок', '∑'],
    'articles' => ['Полезные материалы', '▤'],
    'feedback' => ['Обратная связь', '✉'],
    'messages' => ['Обращения', '☷'],
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title ?? 'Студент PRO') ?> — Студент PRO</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="app-shell">
  <aside class="sidebar" id="sidebar">
    <a class="brand" href="index.php"><span class="brand-mark">S</span><span>Студент<span class="brand-pro">PRO</span></span></a>
    <div class="side-caption">РАБОЧЕЕ ПРОСТРАНСТВО</div>
    <nav class="side-nav">
      <?php foreach ($nav as $key => [$label, $icon]): ?>
        <a class="nav-link <?= $active === $key ? 'active' : '' ?>" href="index.php?route=<?= e($key) ?>">
          <span class="nav-icon"><?= e($icon) ?></span><span><?= e($label) ?></span>
        </a>
      <?php endforeach; ?>
    </nav>
    <div class="sidebar-bottom">
      <div class="help-card"><div class="help-icon">✦</div><strong>Учись в своём темпе</strong><p>Планируй задачи, следи за прогрессом и достигай целей.</p><a href="index.php?route=tasks">К задачам →</a></div>
      <div class="side-user"><div class="avatar">АИ</div><div><strong>Студент</strong><small>Личный кабинет</small></div></div>
    </div>
  </aside>

  <main class="main-area">
    <header class="topbar">
      <button class="menu-toggle" id="menuToggle" aria-label="Открыть меню">☰</button>
      <div><div class="eyebrow">ЛИЧНОЕ УЧЕБНОЕ ПРОСТРАНСТВО</div><h1><?= e($title ?? 'Главная панель') ?></h1></div>
      <div class="topbar-right"><div class="date-chip"><?= date('d.m.Y') ?></div><div class="top-avatar">АИ</div></div>
    </header>

    <?php if ($flashSuccess): ?><div class="alert success"><?= e($flashSuccess) ?></div><?php endif; ?>
    <?php if ($flashError): ?><div class="alert danger"><?= e($flashError) ?></div><?php endif; ?>

    <section class="page-content">
      <?php require $viewFile; ?>
    </section>
    <footer class="footer">Студент PRO <span>Учебный помощник · Курсовой проект</span></footer>
  </main>
</div>
<script src="assets/js/app.js"></script>
</body>
</html>
