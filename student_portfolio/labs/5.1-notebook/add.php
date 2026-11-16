<?php
if (!defined('CONTACT_BOOK')) { http_response_code(403); exit('Доступ запрещён'); }
$data = [];
$message = '';
$messageClass = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add') {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        $message = 'Ошибка: неверный токен безопасности';
        $messageClass = 'error';
    } else {
        try {
            $sql = 'INSERT INTO contacts (surname,name,patronymic,gender,birth_date,phone,address,email,comment) VALUES (:surname,:name,:patronymic,:gender,:birth_date,:phone,:address,:email,:comment)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':surname' => trim($_POST['surname'] ?? ''),
                ':name' => trim($_POST['name'] ?? ''),
                ':patronymic' => trim($_POST['patronymic'] ?? ''),
                ':gender' => $_POST['gender'] ?? '',
                ':birth_date' => ($_POST['birth_date'] ?? '') ?: null,
                ':phone' => trim($_POST['phone'] ?? ''),
                ':address' => trim($_POST['address'] ?? ''),
                ':email' => trim($_POST['email'] ?? ''),
                ':comment' => trim($_POST['comment'] ?? ''),
            ]);
            $message = 'Запись добавлена';
            $messageClass = 'success';
            $data = [];
        } catch (Throwable $e) {
            $message = 'Ошибка: запись не добавлена';
            $messageClass = 'error';
            $data = $_POST;
        }
    }
}
?>
<section class="card narrow"><p class="eyebrow">НОВЫЙ КОНТАКТ</p><h2>Добавление записи</h2>
<?php if ($message): ?><p class="notice <?= $messageClass ?>"><?= e($message) ?></p><?php endif; ?>
<?php
$action = 'add';
$formPage = 'add';
$buttonLabel = 'Сохранить запись';
require __DIR__ . '/form.php';
?></section>
