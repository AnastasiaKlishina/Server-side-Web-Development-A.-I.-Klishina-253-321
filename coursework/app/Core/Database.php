<?php
declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

final class Database
{
    private static ?PDO $connection = null;

    private function __construct() {}

    public static function connection(): PDO
    {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        $config = require dirname(__DIR__) . '/Config/database.php';
        foreach (['host', 'database', 'username', 'password'] as $key) {
            if (!isset($config[$key]) || $config[$key] === '' || str_starts_with((string)$config[$key], 'ИМЯ_') || $config[$key] === 'ПАРОЛЬ_БАЗЫ') {
                throw new RuntimeException('Заполните параметры PostgreSQL в app/Config/database.php.');
            }
        }

        $dsn = sprintf(
            'pgsql:host=%s;port=%s;dbname=%s',
            $config['host'],
            $config['port'] ?? '5432',
            $config['database']
        );

        try {
            self::$connection = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            throw new RuntimeException('Не удалось подключиться к PostgreSQL. Проверьте app/Config/database.php и наличие расширения pdo_pgsql.', 0, $e);
        }

        return self::$connection;
    }
}
