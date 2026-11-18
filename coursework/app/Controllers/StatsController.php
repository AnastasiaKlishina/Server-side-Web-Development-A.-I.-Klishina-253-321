<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Feedback;

final class StatsController extends Controller
{
    public function index(): void
    {
        $this->render('stats/index', ['title'=>'Обращения', 'messages'=>(new Feedback())->latest(20)]);
    }
}
