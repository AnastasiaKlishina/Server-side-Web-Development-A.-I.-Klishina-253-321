<?php

?>
<form method="post" action="index.php?page=<?= e($formPage) ?>" class="contact-form" name="form_add">
    <input type="hidden" name="action" value="<?= e($action) ?>">
    <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
    <?php if ($action === 'edit'): ?>
        <input type="hidden" name="id" value="<?= (int)($data['id'] ?? 0) ?>">
    <?php endif; ?>

    <label>Фамилия
        <input type="text" name="surname" placeholder="Фамилия" required maxlength="100" value="<?= e($data['surname'] ?? '') ?>">
    </label>
    <label>Имя
        <input type="text" name="name" placeholder="Имя" required maxlength="100" value="<?= e($data['name'] ?? '') ?>">
    </label>
    <label>Отчество
        <input type="text" name="patronymic" placeholder="Отчество" maxlength="100" value="<?= e($data['patronymic'] ?? '') ?>">
    </label>
    <label>Пол
        <select name="gender">
            <option value="">Не указан</option>
            <option value="Мужской" <?= (($data['gender'] ?? '') === 'Мужской') ? 'selected' : '' ?>>мужской</option>
            <option value="Женский" <?= (($data['gender'] ?? '') === 'Женский') ? 'selected' : '' ?>>женский</option>
        </select>
    </label>
    <label>Дата рождения
        <input type="date" name="birth_date" value="<?= e($data['birth_date'] ?? '') ?>">
    </label>
    <label>Телефон
        <input type="text" name="phone" placeholder="Телефон" value="<?= e($data['phone'] ?? '') ?>">
    </label>
    <label>Адрес
        <input type="text" name="address" placeholder="Адрес" value="<?= e($data['address'] ?? '') ?>">
    </label>
    <label>Email
        <input type="email" name="email" placeholder="Email" value="<?= e($data['email'] ?? '') ?>">
    </label>
    <label>Комментарий
        <textarea name="comment" placeholder="Краткий комментарий" rows="3"><?= e($data['comment'] ?? '') ?></textarea>
    </label>
    <button class="primary" type="submit"><?= e($buttonLabel) ?></button>
</form>
