<?php
if (!defined('CONTACT_BOOK')) {
    http_response_code(403);
    exit('Доступ запрещён');
}


function render_contacts(string $sort, int $page): string {
    global $pdo;
    $sortColumns = [
        'created' => 'id ASC',
        'surname' => 'surname ASC, name ASC, patronymic ASC',
        'birthdate' => 'birth_date ASC, surname ASC, name ASC',
    ];
    if (!isset($sortColumns[$sort])) {
        $sort = 'created';
    }

    $perPage = 10;
    $total = (int)$pdo->query('SELECT COUNT(*) FROM lab_notebook_contacts')->fetchColumn();
    $pages = max(1, (int)ceil($total / $perPage));
    $page = min(max(1, $page), $pages);
    $offset = ($page - 1) * $perPage;

    $statement = $pdo->query(
        'SELECT * FROM lab_notebook_contacts ORDER BY ' . $sortColumns[$sort] .
        ' LIMIT ' . $perPage . ' OFFSET ' . $offset
    );
    $rows = $statement->fetchAll();

    $html = '<section class="card"><div class="section-head"><div><p class="eyebrow">ВАШИ ДАННЫЕ</p><h2>Список контактов</h2></div><a class="primary" href="index.php?page=add">+ Добавить контакт</a></div>';
    if (!$rows) {
        $html .= '<p class="empty">Записей пока нет. Добавьте первый контакт.</p>';
    } else {
        $html .= '<div class="table-wrap"><table><thead><tr><th>№</th><th>ФИО</th><th>Пол</th><th>Дата рождения</th><th>Телефон</th><th>E-mail</th><th>Адрес</th><th>Комментарий</th></tr></thead><tbody>';
        foreach ($rows as $i => $row) {
            $fio = trim($row['surname'] . ' ' . $row['name'] . ' ' . $row['patronymic']);
            $html .= '<tr><td>' . ($offset + $i + 1) . '</td><td>' . e($fio) . '</td><td>' . e($row['gender']) . '</td><td>' . e($row['birth_date']) . '</td><td>' . e($row['phone']) . '</td><td>' . e($row['email']) . '</td><td>' . e($row['address']) . '</td><td>' . e($row['comment']) . '</td></tr>';
        }
        $html .= '</tbody></table></div>';
    }
    if ($pages > 1) {
        $html .= '<div class="pagination">';
        for ($i = 1; $i <= $pages; $i++) {
            $class = ($i === $page) ? 'page-link current' : 'page-link';
            $html .= '<a class="' . $class . '" href="index.php?page=view&amp;sort=' . e($sort) . '&amp;p=' . $i . '">' . $i . '</a>';
        }
        $html .= '</div>';
    }
    $html .= '<p class="count">Всего контактов: ' . $total . '</p></section>';
    return $html;
}
