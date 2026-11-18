<?php
$total = (int)($taskStats['total'] ?? 0);
$done = (int)($taskStats['done'] ?? 0);
$progress = $total > 0 ? (int)round($done / $total * 100) : 0;
?>
<div class="welcome-row">
  <div><div class="eyebrow purple">ТВОЙ ПРОГРЕСС</div><h2>Привет! Рада видеть тебя 👋</h2><p class="muted">Всё для учёбы — в одном месте. Давай сделаем этот день продуктивным.</p></div>
  <a class="btn primary" href="index.php?route=task-form">＋ Добавить задачу</a>
</div>

<div class="stats-grid">
  <article class="stat-card stat-purple"><div class="stat-top"><span>Задачи выполнены</span><span class="stat-icon">✓</span></div><div class="stat-value"><?= $done ?><small> / <?= $total ?></small></div><div class="stat-foot">Общий прогресс учёбы</div><div class="progress-track"><span style="width:<?= $progress ?>%"></span></div></article>
  <article class="stat-card stat-green"><div class="stat-top"><span>В процессе</span><span class="stat-icon">◷</span></div><div class="stat-value"><?= (int)($taskStats['process'] ?? 0) ?></div><div class="stat-foot">Задачи, над которыми работаешь</div></article>
  <article class="stat-card stat-orange"><div class="stat-top"><span>Запланировано</span><span class="stat-icon">▣</span></div><div class="stat-value"><?= (int)($taskStats['planned'] ?? 0) ?></div><div class="stat-foot">То, что ещё предстоит сделать</div></article>
  <article class="stat-card stat-blue"><div class="stat-top"><span>Средний балл</span><span class="stat-icon">★</span></div><div class="stat-value"><?= e($gradeStats['average'] ?? '0.00') ?></div><div class="stat-foot">По добавленным оценкам</div></article>
</div>

<div class="dashboard-grid">
  <article class="panel panel-large">
    <div class="panel-heading"><div><h3>Учебная активность</h3><p>Распределение задач по статусам</p></div><a class="text-link" href="index.php?route=tasks">Все задачи →</a></div>
    <div class="chart-wrap"><canvas id="taskChart" data-done="<?= $done ?>" data-process="<?= (int)($taskStats['process'] ?? 0) ?>" data-planned="<?= (int)($taskStats['planned'] ?? 0) ?>"></canvas></div>
  </article>
  <article class="panel">
    <div class="panel-heading"><div><h3>Ближайшие дедлайны</h3><p>Не забудь про важное</p></div></div>
    <?php if (!$upcoming): ?><div class="empty-state compact"><span>☀</span><strong>Пока нет дедлайнов</strong><p>Добавь задачу и укажи дату сдачи.</p></div>
    <?php else: ?><div class="deadline-list"><?php foreach ($upcoming as $task): ?><div class="deadline-item"><span class="deadline-dot <?= e($task['priority']) ?>"></span><div><strong><?= e($task['title']) ?></strong><small><?= e(date('d.m.Y', strtotime($task['due_date']))) ?></small></div></div><?php endforeach; ?></div><?php endif; ?>
  </article>
  <article class="panel panel-large">
    <div class="panel-heading"><div><h3>Полезные материалы</h3><p>Небольшие подсказки для учёбы</p></div><a class="text-link" href="index.php?route=articles">Все статьи →</a></div>
    <div class="mini-articles"><?php foreach ($recentArticles as $article): ?><a class="mini-article" href="index.php?route=article&id=<?= (int)$article['id'] ?>"><span class="article-symbol">✦</span><span><small><?= e($article['category']) ?></small><strong><?= e($article['title']) ?></strong></span><span class="arrow">↗</span></a><?php endforeach; ?></div>
  </article>
  <article class="panel quote-panel"><div class="quote-mark">“</div><h3>Маленькие шаги каждый день приводят к большим результатам.</h3><p>Твой прогресс складывается из регулярных действий.</p><a class="btn light" href="index.php?route=calculator">Рассчитать оценку</a></article>
</div>
