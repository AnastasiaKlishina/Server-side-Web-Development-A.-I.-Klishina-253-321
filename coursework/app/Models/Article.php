<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Article extends Model
{
    protected string $table = 'articles';

    public function latest(int $limit = 20): array
    {
        return $this->all("SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT " . max(1, min(50, $limit)));
    }

    public function find(int $id): ?array
    {
        return $this->one("SELECT * FROM {$this->table} WHERE id=:id", ['id'=>$id]);
    }

    public function create(array $data): void
    {
        $this->execute("INSERT INTO {$this->table} (title, category, excerpt, content) VALUES (:title, :category, :excerpt, :content)", $data);
    }

    public function delete(int $id): void
    {
        $this->execute("DELETE FROM {$this->table} WHERE id=:id", ['id'=>$id]);
    }
}
