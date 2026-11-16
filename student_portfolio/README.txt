УЧЕБНОЕ ПОРТФОЛИО — КЛИШИНА А.И., группа 253-321
================================================

УСТАНОВКА В XAMPP
1. Распакуйте папку student_portfolio в C:\xampp\htdocs\.
2. Запустите Apache в XAMPP.
3. Откройте http://localhost/student_portfolio/.

РАБОТЫ
4.1. Домашняя работа: Feedback Form
Папка: labs/4.1-feedback-form/
Старт: http://localhost/student_portfolio/labs/4.1-feedback-form/
Форма отправляет POST на https://httpbin.org/post (ответ открывается в новой вкладке).
Страница headers.php выводит результат PHP-функции get_headers() для https://httpbin.org/get в textarea.

5.1. Домашняя работа: Notebook
Папка: labs/5.1-notebook/
Старт: http://localhost/student_portfolio/labs/5.1-notebook/
Перед запуском импортируйте labs/5.1-notebook/schema.sql через phpMyAdmin.
База: contact_book. Если логин/пароль MySQL отличаются от стандартных XAMPP, измените labs/5.1-notebook/config.php.

2.1. Домашняя работа с роутингом
2.2. Домашняя работа с представлением
Папка: labs/2.1-2.2-controller/
Старт: http://localhost/student_portfolio/labs/2.1-2.2-controller/public/
Проверка: /hello/Аня и /bye/Аня. Для корректной работы маршрутов включён .htaccess (mod_rewrite).
Виртуальный хост не требуется; Apache должен разрешать .htaccess (AllowOverride All).

3.1. Домашняя работа: ArticlesController
Папка: labs/3.1-blog/
Старт: http://localhost/student_portfolio/labs/3.1-blog/public/
Импортируйте labs/3.1-blog/database.sql через phpMyAdmin. Скрипт создаёт базу student_blog,
таблицы users и articles и демонстрационные записи. Подключение настроено на root без пароля.
В show() сначала выбирается статья, затем отдельным запросом nickname автора из users.

ВОЗВРАТ НА ГЛАВНУЮ
Во всех разделах добавлена ссылка «К списку лабораторных».
