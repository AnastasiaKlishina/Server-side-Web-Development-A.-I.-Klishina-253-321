<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Task extends Model
{
    protected string $table = 'tasks';

    public function allTasks(string $filter = 'all'): array
    {
        $where = '';
        if (in_array($filter, ['planned', 'process', 'done'], true)) {
            $where = ' WHERE status = :status';
            return $this->all("SELECT * FROM {$this->table}{$where} ORDER BY due_date NULLS LAST, id DESC", ['status' => $filter]);
        }
        return $this->all("SELECT * FROM {$this->table} ORDER BY due_date NULLS LAST, id DESC");
    }

    public function find(int $id): ?array
    {
        return $this->one("SELECT * FROM {$this->table} WHERE id = :id", ['id' => $id]);
    }

    public function create(array $data): void
    {
        $this->execute(
            "INSERT INTO {$this->table} (title, description, due_date, priority, status) VALUES (:title, :description, :due_date, :priority, :status)",
            $data
        );
    }

    public function update(int $id, array $data): void
    {
        $data['id'] = $id;
        $this->execute(
            "UPDATE {$this->table} SET title=:title, description=:description, due_date=:due_date, priority=:priority, status=:status, updated_at=CURRENT_TIMESTAMP WHERE id=:id",
            $data
        );
    }

    public function delete(int $id): void
    {
        $this->execute("DELETE FROM {$this->table} WHERE id=:id", ['id' => $id]);
    }

    public function counts(): array
    {
        $row = $this->one("SELECT COUNT(*) AS total, COUNT(*) FILTER (WHERE status='done') AS done, COUNT(*) FILTER (WHERE status='process') AS process, COUNT(*) FILTER (WHERE status='planned') AS planned FROM {$this->table}");
        return $row ?? ['total'=>0,'done'=>0,'process'=>0,'planned'=>0];
    }

    public function upcoming(int $limit = 5): array
    {
        return $this->all("SELECT * FROM {$this->table} WHERE status <> 'done' AND due_date IS NOT NULL ORDER BY due_date ASC LIMIT " . max(1, min(10, $limit)));
    }
}
