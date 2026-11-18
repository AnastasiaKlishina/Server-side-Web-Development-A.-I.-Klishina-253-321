<!doctype html>
<html lang="ru">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Ошибка — Студент PRO</title>
<body style="font:16px Arial,sans-serif;background:#f2f7f5;padding:40px;color:#243047">
<main style="max-width:700px;margin:auto;background:white;border-radius:18px;padding:30px">
<h1>Не удалось открыть страницу</h1>
<p>
<?= htmlspecialchars($safeMessage ?? 'Внутренняя ошибка.', ENT_QUOTES, 'UTF-8') ?>
</p>
<p>Проверьте параметры PostgreSQL и расширение pdo_pgsql. После исправления обновите страницу.</p>
</main>
</body>
</html>
