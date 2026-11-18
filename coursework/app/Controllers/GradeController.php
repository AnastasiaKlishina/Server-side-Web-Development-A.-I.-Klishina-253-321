<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Grade;

final class GradeController extends Controller
{
    public function index(): void
    {
        $model = new Grade();
        $this->render('grades/index', ['title'=>'Успеваемость', 'grades'=>$model->allGrades(), 'summary'=>$model->summary(), 'chart'=>$model->chartData()]);
    }

    public function save(): void
    {
        $this->requirePost();
        $subject = trim((string)($_POST['subject'] ?? ''));
        $grade = filter_var($_POST['grade'] ?? null, FILTER_VALIDATE_INT);
        $weight = filter_var($_POST['weight'] ?? 1, FILTER_VALIDATE_FLOAT);
        if ($subject === '' || mb_strlen($subject) > 120 || $grade === false || $grade < 2 || $grade > 5 || $weight === false || $weight <= 0 || $weight > 100) {
            $_SESSION['flash_error'] = 'Введите предмет, оценку от 2 до 5 и корректный вес.';
            $this->redirect('grades');
        }
        (new Grade())->create([
            'subject'=>$subject,
            'grade'=>$grade,
            'weight'=>$weight,
            'exam_date'=>($_POST['exam_date'] ?? '') !== '' ? $_POST['exam_date'] : null,
            'note'=>trim((string)($_POST['note'] ?? '')),
        ]);
        $_SESSION['flash_success'] = 'Оценка добавлена.';
        $this->redirect('grades');
    }

    public function delete(): void
    {
        $this->requirePost();
        (new Grade())->delete((int)($_POST['id'] ?? 0));
        $_SESSION['flash_success'] = 'Оценка удалена.';
        $this->redirect('grades');
    }
}
