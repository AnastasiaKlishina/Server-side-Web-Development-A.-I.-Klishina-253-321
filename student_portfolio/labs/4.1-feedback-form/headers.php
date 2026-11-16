<?php
$url = 'https://httpbin.org/get';
$headers = @get_headers($url);
$result = ($headers === false)
    ? "Не удалось получить заголовки для URL: " . $url . "\nПроверьте подключение к Интернету и настройки PHP."
    : "URL: " . $url . "\n\n" . implode("\n", $headers);
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Результат get_headers</title><link rel="stylesheet" href="style.css">
    </head>
<body>
    <header>
        <a class="brand" href="index.html" aria-label="Московский Политех">
            <img src="moscow-polytech-logo.png" alt="Московский Политех">
        </a>
        <div class="work">Лабораторная работа<br>«Feedback form»</div></header>
<main>
    <a class="back-home" href="/">← К списку лабораторных</a>
    <section class="panel">
        <p class="eyebrow">РЕЗУЛЬТАТ ВЫПОЛНЕНИЯ</p>
    <h1>Функция get_headers()</h1>
    <p class="muted">HTTP-заголовки ответа сервера для https://httpbin.org/get:</p>
<label for="result">Результат работы функции get_headers</label>
<textarea id="result" class="output" rows="18" readonly><?php echo htmlspecialchars($result, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></textarea>
<a class="button-link" href="index.html">Вернуться к форме</a>
</section>
</main>
<footer>Задание для самостоятельной работы</footer>
</body>
</html>