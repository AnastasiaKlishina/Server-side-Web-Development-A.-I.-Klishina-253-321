<?php $task = $task ?? null; ?>
<div class="page-toolbar"><div><h2><?= $task ? 'Изменить задачу' : 'Новая задача' ?></h2><p class="muted">Заполни информацию об учебном задании.</p></div><a class="btn secondary" href="index.php?route=tasks">← Назад</a></div>
<form class="panel form-panel" method="post" action="index.php?route=task-save">
<input type="hidden" name="_token" value="<?= e($_SESSION['_token']) ?>"><input type="hidden" name="id" value="<?= (int)($task['id'] ?? 0) ?>">
<label>Название задачи<input required maxlength="180" name="title" value="<?= e($task['title'] ?? '') ?>" placeholder="Например, подготовить лабораторную работу"></label>
<label>Описание<textarea name="description" rows="4" placeholder="Дополнительные детали..."><?= e($task['description'] ?? '') ?></textarea></label>
<div class="form-grid">
<label>Срок выполнения<input type="date" name="due_date" value="<?= e($task['due_date'] ?? '') ?>"></label>
<label>Приоритет<select name="priority"><?php foreach (['low'=>'Низкий','normal'=>'Обычный','high'=>'Высокий'] as $v=>$label): ?><option value="<?= $v ?>" <?= ($task['priority'] ?? 'normal')===$v?'selected':'' ?>><?= $label ?></option><?php endforeach; ?></select></label>
<label>Статус<select name="status"><?php foreach (['planned'=>'Запланировано','process'=>'В процессе','done'=>'Выполнено'] as $v=>$label): ?><option value="<?= $v ?>" <?= ($task['status'] ?? 'planned')===$v?'selected':'' ?>><?= $label ?></option><?php endforeach; ?></select></label>
</div><button class="btn primary" type="submit">Сохранить задачу</button>
</form>
