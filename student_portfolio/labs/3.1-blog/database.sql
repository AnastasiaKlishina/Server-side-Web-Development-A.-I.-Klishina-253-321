-- Импортировать, предварительно выбрав базу miavertiko в phpMyAdmin.
-- Таблицы имеют отдельный префикс и не затрагивают старые email/orders/products/users.

CREATE TABLE IF NOT EXISTS lab_blog_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nickname VARCHAR(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS lab_blog_articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_lab_blog_articles_user
        FOREIGN KEY (user_id) REFERENCES lab_blog_users(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO lab_blog_users (id, nickname) VALUES
(1, 'Anna'),
(2, 'Alex');

INSERT IGNORE INTO lab_blog_articles (id, title, content, user_id) VALUES
(1, 'Первая статья', 'Всем привет! Это текст первой статьи моего учебного блога.', 1),
(2, 'Вторая статья', 'Это вторая статья. Её автор хранится в таблице users.', 2);
