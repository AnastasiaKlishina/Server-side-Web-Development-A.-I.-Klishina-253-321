<div class="welcome-row">
<div>
<div class="eyebrow purple">ПЛАНИРУЙ РЕЗУЛЬТАТ</div>
<h2>Калькулятор экзаменационной оценки</h2>
<p class="muted">Узнай, какую оценку нужно получить на экзамене для достижения цели.</p>
</div>
</div>
<div class="two-column">
<form class="panel form-panel" method="get">
<input type="hidden" name="route" value="calculator">
<label>Текущий средний балл<input type="number" name="current" min="2" max="5" step="0.01" required value="<?= $current !== null ? e($current) : '' ?>" placeholder="Например, 3.8">
</label>
<label>Желаемый итоговый балл<input type="number" name="target" min="2" max="5" step="0.1" required value="<?= e($target) ?>">
</label>
<label>Количество текущих оценок (условный вес)<input type="number" name="weight" min="0.1" max="100" step="0.1" required value="<?= e($weight) ?>">
</label>
<p class="hint">Модель расчёта предполагает, что экзамен имеет вес одной оценки. Это упрощённый учебный калькулятор.</p>
<button class="btn primary">Рассчитать</button>
</form>
<div class="panel result-panel">
<?php if ($result): ?>
<div class="result-icon">
<?= $result['possible'] ? '✓' : '!' ?>
</div>
<div class="eyebrow purple">РЕЗУЛЬТАТ РАСЧЁТА</div>
<div class="result-number">
<?= e($result['needed']) ?>
<small> балла</small>
</div>
<h3>
<?= e($result['message']) ?>
</h3>
<p class="muted">Расчёт: (цель × (вес текущих оценок + 1)) − (текущий средний балл × вес текущих оценок).</p>
<?php else: ?>
<div class="result-icon">∑</div>
<h3>Введи свои данные</h3>
<p class="muted">Калькулятор покажет требуемый результат экзамена.</p>
<?php endif; ?>
</div>
</div>
