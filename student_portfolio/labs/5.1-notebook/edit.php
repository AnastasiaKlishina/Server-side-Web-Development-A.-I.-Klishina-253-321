<?php
if (!defined('CONTACT_BOOK')) { http_response_code(403); exit('Доступ запрещён'); }
$lab_notebook_contacts = $pdo->query('SELECT id,surname,name,patronymic FROM lab_notebook_contacts ORDER BY surname,name,patronymic')->fetchAll();
$selectedId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$selectedId && $lab_notebook_contacts) { $selectedId = (int)$lab_notebook_contacts[0]['id']; }
$data = [];
if ($selectedId) {
    $stmt = $pdo->prepare('SELECT * FROM lab_notebook_contacts WHERE id = ?');
    $stmt->execute([$selectedId]);
    $data = $stmt->fetch() ?: [];
}
$message = '';
$messageClass = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'edit') {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        $message = 'Ошибка: неверный токен безопасности'; $messageClass = 'error';
    } else {
        $selectedId = (int)($_POST['id'] ?? 0);
        try {
            $stmt = $pdo->prepare('UPDATE lab_notebook_contacts SET surname=:surname,name=:name,patronymic=:patronymic,gender=:gender,birth_date=:birth_date,phone=:phone,address=:address,email=:email,comment=:comment WHERE id=:id');
            $stmt->execute([
                ':surname'=>trim($_POST['surname']??''), ':name'=>trim($_POST['name']??''),
                ':patronymic'=>trim($_POST['patronymic']??''), ':gender'=>$_POST['gender']??'',
                ':birth_date'=>($_POST['birth_date']??'')?:null, ':phone'=>trim($_POST['phone']??''),
                ':address'=>trim($_POST['address']??''), ':email'=>trim($_POST['email']??''),
                ':comment'=>trim($_POST['comment']??''), ':id'=>$selectedId
            ]);
            $message = 'Запись обновлена'; $messageClass = 'success';
        } catch (Throwable $e) { $message = 'Ошибка: запись не изменена'; $messageClass = 'error'; }
        $stmt = $pdo->prepare('SELECT * FROM lab_notebook_contacts WHERE id=?'); $stmt->execute([$selectedId]); $data = $stmt->fetch() ?: [];
        $lab_notebook_contacts = $pdo->query('SELECT id,surname,name,patronymic FROM lab_notebook_contacts ORDER BY surname,name,patronymic')->fetchAll();
    }
}
?>
<section class="card"><p class="eyebrow">УПРАВЛЕНИЕ КОНТАКТАМИ</p><h2>Редактирование записи</h2>
<?php if (!$lab_notebook_contacts): ?><p class="empty">Нет контактов для редактирования. Сначала добавьте запись.</p><?php else: ?>
<div class="record-list"><?php foreach ($lab_notebook_contacts as $contact): $label = trim($contact['surname'].' '.$contact['name'].' '.$contact['patronymic']); ?>
<a class="<?= ((int)$selectedId === (int)$contact['id']) ? 'record selected' : 'record' ?>" href="index.php?page=edit&amp;id=<?= (int)$contact['id'] ?>"><?= e($label) ?></a>
<?php endforeach; ?></div>
<?php if ($message): ?><p class="notice <?= $messageClass ?>"><?= e($message) ?></p><?php endif; ?>
<?php
$action = 'edit';
$formPage = 'edit';
$buttonLabel = 'Сохранить изменения';
require __DIR__ . '/form.php';
?>
<?php endif; ?></section>
