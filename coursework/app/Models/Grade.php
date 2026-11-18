<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Grade extends Model
{
    protected string $table = 'grades';

    public function allGrades(): array
    {
        return $this->all("SELECT * FROM {$this->table} ORDER BY exam_date DESC NULLS LAST, id DESC");
    }

    public function create(array $data): void
    {
        $this->execute("INSERT INTO {$this->table} (subject, grade, weight, exam_date, note) VALUES (:subject, :grade, :weight, :exam_date, :note)", $data);
    }

    public function delete(int $id): void
    {
        $this->execute("DELETE FROM {$this->table} WHERE id=:id", ['id'=>$id]);
    }

    public function summary(): array
    {
        return $this->one("SELECT COUNT(*) AS total, COALESCE(ROUND(AVG(grade)::numeric, 2), 0) AS average, COALESCE(MIN(grade), 0) AS min_grade, COALESCE(MAX(grade), 0) AS max_grade FROM {$this->table}") ?? [];
    }

    public function chartData(): array
    {
        return $this->all("SELECT subject, ROUND(AVG(grade)::numeric, 2) AS average FROM {$this->table} GROUP BY subject ORDER BY subject");
    }
}
