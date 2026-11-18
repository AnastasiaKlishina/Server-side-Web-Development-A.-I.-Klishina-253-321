<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class CalculatorController extends Controller
{
    public function index(): void
    {
        $current = isset($_GET['current']) ? (float)$_GET['current'] : null;
        $target = isset($_GET['target']) ? (float)$_GET['target'] : 4.0;
        $weight = isset($_GET['weight']) ? (float)$_GET['weight'] : 1.0;
        $result = null;
        if ($current !== null && $weight > 0 && $weight <= 100 && $target >= 2 && $target <= 5) {
            // Средневзвешенная оценка: (текущая сумма * текущий вес + экзамен * вес экзамена) / общий вес.
            $examWeight = 1.0;
            $needed = ($target * ($weight + $examWeight) - $current * $weight) / $examWeight;
            $result = ['needed'=>round($needed, 2), 'possible'=>$needed <= 5, 'message'=>$needed <= 2 ? 'Целевая оценка уже достигнута.' : ($needed > 5 ? 'Достичь цели одной экзаменационной оценкой невозможно.' : 'Для достижения цели нужна указанная оценка или выше.')];
        }
        $this->render('calculator/index', ['title'=>'Калькулятор оценок', 'result'=>$result, 'current'=>$current, 'target'=>$target, 'weight'=>$weight]);
    }
}
