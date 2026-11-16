<?php
declare(strict_types=1);

final class Database
{
    public static function connect(): PDO
    {
        $host = 'localhost';
        $db = 'student_blog';
        $user = 'root';
        $pass = '';
        return new PDO(
            "mysql:host={$host};dbname={$db};charset=utf8mb4",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }
}
