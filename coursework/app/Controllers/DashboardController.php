<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Task;
use App\Models\Grade;
use App\Models\Article;

final class DashboardController extends Controller
{
    public function index(): void
    {
        $tasks = new Task();
        $grades = new Grade();
        $articles = new Article();
        $this->render('dashboard', [
            'title' => 'Главная панель',
            'taskStats' => $tasks->counts(),
            'gradeStats' => $grades->summary(),
            'upcoming' => $tasks->upcoming(),
            'recentArticles' => array_slice($articles->latest(5), 0, 3),
            'gradeChart' => $grades->chartData(),
        ]);
    }
}
