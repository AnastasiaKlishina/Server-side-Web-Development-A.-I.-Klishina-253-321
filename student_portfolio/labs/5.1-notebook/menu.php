<?php
if (!defined('CONTACT_BOOK')) {
    http_response_code(403);
    exit('Доступ запрещён');
}


function get_menu(): string {
    $active = $_GET['page'] ?? 'view';
    if (!in_array($active, ['view', 'add', 'edit', 'delete'], true)) {
        $active = 'view';
    }
    $sort = $_GET['sort'] ?? 'created';
    if (!in_array($sort, ['created', 'surname', 'birthdate'], true)) {
        $sort = 'created';
    }

    $items = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи',
    ];
    $html = '<div class="main-menu">';
    foreach ($items as $key => $label) {
        $class = ($active === $key) ? 'menu-btn active' : 'menu-btn';
        $html .= '<a class="' . $class . '" href="index.php?page=' . $key . '">' . $label . '</a>';
    }
    $html .= '</div>';

    if ($active === 'view') {
        $sorts = [
            'created' => 'По дате добавления',
            'surname' => 'По фамилии',
            'birthdate' => 'По дате рождения',
        ];
        $html .= '<div class="sub-menu">';
        foreach ($sorts as $key => $label) {
            $class = ($sort === $key) ? 'sub-btn active' : 'sub-btn';
            $html .= '<a class="' . $class . '" href="index.php?page=view&amp;sort=' . $key . '">' . $label . '</a>';
        }
        $html .= '</div>';
    }
    return $html;
}
