<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Feedback;

final class FeedbackController extends Controller
{
    public function index(): void
    {
        $this->render('feedback/index', ['title'=>'Обратная связь']);
    }

    public function send(): void
    {
        $this->requirePost();
        $name = trim((string)($_POST['name'] ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $topic = trim((string)($_POST['topic'] ?? 'Вопрос'));
        $message = trim((string)($_POST['message'] ?? ''));
        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $message === '') {
            $_SESSION['flash_error'] = 'Заполните имя, корректный e-mail и текст сообщения.';
            $this->redirect('feedback');
        }
        (new Feedback())->create(['name'=>$name,'email'=>$email,'topic'=>$topic,'message'=>$message]);
        $_SESSION['flash_success'] = 'Спасибо! Ваше обращение сохранено.';
        $this->redirect('feedback');
    }
}
