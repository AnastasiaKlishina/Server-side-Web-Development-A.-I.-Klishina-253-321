<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Task;
use Throwable;

final class TaskController extends Controller
{
    public function index(): void
    {
        $filter = (string)($_GET['status'] ?? 'all');
        $this->render('tasks/index', ['title'=>'Учебные задачи', 'tasks'=>(new Task())->allTasks($filter), 'filter'=>$filter]);
    }

    public function save(): void
    {
        $this->requirePost();
        $id = (int)($_POST['id'] ?? 0);
        $title = trim((string)($_POST['title'] ?? ''));
        $status = (string)($_POST['status'] ?? 'planned');
        $priority = (string)($_POST['priority'] ?? 'normal');
        if ($title === '' || mb_strlen($title) > 180 || !in_array($status, ['planned','process','done'], true) || !in_array($priority, ['low','normal','high'], true)) {
            $_SESSION['flash_error'] = 'Проверьте название задачи и выбранные параметры.';
            $this->redirect('tasks');
        }
        $data = [
            'title'=>$title,
            'description'=>trim((string)($_POST['description'] ?? '')),
            'due_date'=>($_POST['due_date'] ?? '') !== '' ? $_POST['due_date'] : null,
            'priority'=>$priority,
            'status'=>$status,
        ];
        $model = new Task();
        if ($id > 0) $model->update($id, $data); else $model->create($data);
        $_SESSION['flash_success'] = 'Задача сохранена.';
        $this->redirect('tasks');
    }

    public function delete(): void
    {
        $this->requirePost();
        (new Task())->delete((int)($_POST['id'] ?? 0));
        $_SESSION['flash_success'] = 'Задача удалена.';
        $this->redirect('tasks');
    }

    public function editForm(): void
    {
        $task = (new Task())->find((int)($_GET['id'] ?? 0));
        $this->render('tasks/form', ['title'=>$task ? 'Редактирование задачи' : 'Новая задача', 'task'=>$task]);
    }
}
