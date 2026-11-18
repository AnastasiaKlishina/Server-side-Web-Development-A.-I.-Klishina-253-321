<div class="page-toolbar">
<div>
<h2>Мои учебные задачи</h2>
<p class="muted">Планируй работу и отмечай выполненное.</p>
</div>
<a class="btn primary" href="index.php?route=task-form">＋ Новая задача</a>
</div>
<div class="filter-row">
  <a class="<?= $filter==='all'?'selected':'' ?>" href="index.php?route=tasks">Все</a>
  <a class="<?= $filter==='planned'?'selected':'' ?>" href="index.php?route=tasks&status=planned">Запланировано</a>
  <a class="<?= $filter==='process'?'selected':'' ?>" href="index.php?route=tasks&status=process">В процессе</a>
  <a class="<?= $filter==='done'?'selected':'' ?>" href="index.php?route=tasks&status=done">Выполнено</a>
</div>
<div class="panel table-panel">
<?php if (!$tasks): ?>
<div class="empty-state">
<span>✓</span>
<strong>Задач пока нет</strong>
<p>Добавь первую учебную задачу.</p>
</div>
<?php else: ?>
<div class="table-scroll">
<table>
<thead>
<tr>
<th>Задача</th>
<th>Срок</th>
<th>Приоритет</th>
<th>Статус</th>
<th>Действия</th>
</tr>
</thead>
<tbody>
<?php foreach ($tasks as $task): ?>
<tr>
<td>
<strong>
<?= e($task['title']) ?>
</strong>
<small class="table-sub">
<?= e($task['description']) ?>
</small>
</td>
<td>
<?= $task['due_date'] ? e(date('d.m.Y', strtotime($task['due_date']))) : '—' ?>
</td>
<td>
<span class="priority <?= e($task['priority']) ?>">
<?= ['low'=>'Низкий','normal'=>'Обычный','high'=>'Высокий'][$task['priority']] ?? 'Обычный' ?>
</span>
</td>
<td>
<span class="status <?= e($task['status']) ?>">
<?= ['planned'=>'Запланировано','process'=>'В процессе','done'=>'Выполнено'][$task['status']] ?? '' ?>
</span>
</td>
<td>
<div class="actions">
<a class="icon-action" title="Изменить" href="index.php?route=task-form&id=<?= (int)$task['id'] ?>">✎</a>
<form method="post" action="index.php?route=task-delete" onsubmit="return confirm('Удалить задачу?')">
<input type="hidden" name="_token" value="<?= e($_SESSION['_token']) ?>">
<input type="hidden" name="id" value="<?= (int)$task['id'] ?>">
<button class="icon-action danger-text" title="Удалить">×</button>
</form>
</div>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
<?php endif; ?>
</div>
