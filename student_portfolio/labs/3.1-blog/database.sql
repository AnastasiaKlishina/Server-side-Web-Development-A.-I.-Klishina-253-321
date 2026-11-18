CREATE DATABASE IF NOT EXISTS student_blog
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_blog;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nickname VARCHAR(80) NOT NULL
);

CREATE TABLE IF NOT EXISTS articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_articles_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
);

INSERT INTO users (id, nickname) VALUES
(1, 'Anna'),
(2, 'Alex');

INSERT INTO articles (id, title, content, user_id) VALUES
(1, 'Первая статья', 'Всем привет! Это текст первой статьи моего учебного блога.', 1),
(2, 'Вторая статья', 'Это вторая статья. Её автор хранится в таблице users.', 2);
