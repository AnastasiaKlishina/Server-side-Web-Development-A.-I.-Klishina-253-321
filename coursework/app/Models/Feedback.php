<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Feedback extends Model
{
    protected string $table = 'feedback';

    public function create(array $data): void
    {
        $this->execute("INSERT INTO {$this->table} (name, email, topic, message) VALUES (:name, :email, :topic, :message)", $data);
    }

    public function latest(int $limit = 10): array
    {
        return $this->all("SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT " . max(1, min(30, $limit)));
    }
}
