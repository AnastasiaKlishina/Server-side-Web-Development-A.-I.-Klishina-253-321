<?php
if (!defined('CONTACT_BOOK')) { http_response_code(403); exit('Доступ запрещён'); }
$message = '';
if (isset($_GET['id']) && ctype_digit((string)$_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare('SELECT surname FROM contacts WHERE id=?');
    $stmt->execute([$id]);
    $surname = $stmt->fetchColumn();
    if ($surname !== false) {
        $del = $pdo->prepare('DELETE FROM contacts WHERE id=?');
        $del->execute([$id]);
        $message = 'Запись с фамилией ' . $surname . ' удалена';
    }
}
$contacts = $pdo->query('SELECT id,surname,name,patronymic FROM contacts ORDER BY surname,name,patronymic')->fetchAll();
?>
<section class="card narrow"><p class="eyebrow">УПРАВЛЕНИЕ КОНТАКТАМИ</p><h2>Удаление записи</h2>
<?php if ($message): ?><p class="notice success"><?= e($message) ?></p><?php endif; ?>
<?php if (!$contacts): ?><p class="empty">Список контактов пуст.</p><?php else: ?>
<p class="muted">Выберите контакт, который необходимо удалить:</p><div class="record-list">
<?php foreach ($contacts as $contact): $initials = mb_substr($contact['name'],0,1).'.'.($contact['patronymic'] ? mb_substr($contact['patronymic'],0,1).'.' : ''); ?>
<a class="record danger-link" href="index.php?page=delete&amp;id=<?= (int)$contact['id'] ?>" onclick="return confirm('Удалить запись <?= e($contact['surname'].' '.$initials) ?>?')"><?= e($contact['surname'].' '.$initials) ?></a>
<?php endforeach; ?></div><?php endif; ?></section>
