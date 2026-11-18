-- Студент PRO. PostgreSQL schema + демонстрационные данные.
CREATE TABLE IF NOT EXISTS tasks (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    description TEXT NOT NULL DEFAULT '',
    due_date DATE NULL,
    priority VARCHAR(10) NOT NULL DEFAULT 'normal' CHECK (priority IN ('low','normal','high')),
    status VARCHAR(10) NOT NULL DEFAULT 'planned' CHECK (status IN ('planned','process','done')),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS grades (
    id BIGSERIAL PRIMARY KEY,
    subject VARCHAR(120) NOT NULL,
    grade SMALLINT NOT NULL CHECK (grade BETWEEN 2 AND 5),
    weight NUMERIC(6,2) NOT NULL DEFAULT 1 CHECK (weight > 0),
    exam_date DATE NULL,
    note VARCHAR(255) NOT NULL DEFAULT '',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS articles (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    category VARCHAR(80) NOT NULL DEFAULT 'Общее',
    excerpt VARCHAR(220) NOT NULL DEFAULT '',
    content TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS feedback (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(180) NOT NULL,
    topic VARCHAR(80) NOT NULL DEFAULT 'Вопрос',
    message TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tasks (title, description, due_date, priority, status)
SELECT 'Подготовить курсовой проект', 'Завершить функциональность и проверить работу сайта.', CURRENT_DATE + INTERVAL '5 days', 'high', 'process'
WHERE NOT EXISTS (SELECT 1 FROM tasks);
INSERT INTO tasks (title, description, due_date, priority, status)
SELECT 'Повторить материал по PHP', 'ООП, MVC, маршрутизация и работа с базой данных.', CURRENT_DATE + INTERVAL '2 days', 'normal', 'planned'
WHERE (SELECT COUNT(*) FROM tasks) < 2;
INSERT INTO tasks (title, description, due_date, priority, status)
SELECT 'Оформить лабораторную работу', 'Проверить отчёт и добавить скриншоты.', CURRENT_DATE - INTERVAL '1 day', 'low', 'done'
WHERE (SELECT COUNT(*) FROM tasks) < 3;

INSERT INTO grades (subject, grade, weight, exam_date, note)
SELECT 'Программирование', 5, 1, CURRENT_DATE - INTERVAL '12 days', 'Практическая работа'
WHERE NOT EXISTS (SELECT 1 FROM grades);
INSERT INTO grades (subject, grade, weight, exam_date, note)
SELECT 'Базы данных', 4, 1, CURRENT_DATE - INTERVAL '8 days', 'Контрольная работа'
WHERE (SELECT COUNT(*) FROM grades) < 2;
INSERT INTO grades (subject, grade, weight, exam_date, note)
SELECT 'Веб-разработка', 5, 1, CURRENT_DATE - INTERVAL '3 days', 'Лабораторная работа'
WHERE (SELECT COUNT(*) FROM grades) < 3;

INSERT INTO articles (title, category, excerpt, content)
SELECT 'Как составить реалистичный учебный план', 'Планирование', 'Разбей большую цель на небольшие задачи и назначь каждой понятный срок.', 'Начни с перечня всех дел. Раздели большие задания на небольшие шаги, оцени время на каждый шаг и расставь приоритеты. Оставляй запас времени на проверку и исправления. В конце недели оцени, что получилось, и скорректируй план.'
WHERE NOT EXISTS (SELECT 1 FROM articles);
INSERT INTO articles (title, category, excerpt, content)
SELECT 'Метод коротких учебных интервалов', 'Продуктивность', 'Чередуй сосредоточенную работу и короткие перерывы, чтобы сохранять внимание.', 'Выбери одну конкретную задачу и работай над ней без отвлечений в течение выбранного интервала. Затем сделай небольшой перерыв. После нескольких циклов устрой более длинный отдых. Подбирай длительность под сложность материала и собственный темп.'
WHERE (SELECT COUNT(*) FROM articles) < 2;
INSERT INTO articles (title, category, excerpt, content)
SELECT 'Как подготовиться к экзамену без аврала', 'Подготовка', 'Регулярное повторение и самопроверка помогают лучше распределить нагрузку.', 'Составь список тем, отметь сложные разделы и распредели их по дням. Используй активное воспроизведение: отвечай на вопросы без подсказок, решай практические задания и возвращайся к ошибкам. Накануне экзамена оставь время на отдых.'
WHERE (SELECT COUNT(*) FROM articles) < 3;
