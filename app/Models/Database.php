<?php

namespace App\Models;

use PDO;

class Database
{
    private static ?PDO $instance = null;

    public static function connect(): PDO
    {
        if (self::$instance === null) {
            self::$instance = new PDO('sqlite:' . __DIR__ . '/../../database/db.sqlite');
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }

    public static function select(string $query, array $params = []): array
    {
        $stmt = self::connect()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function selectOne(string $query, array $params = []): ?array
    {
        $stmt = self::connect()->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public static function insert(string $query, array $params = []): int
    {
        $stmt = self::connect()->prepare($query);
        $stmt->execute($params);
        return (int) self::connect()->lastInsertId();
    }

    public static function update(string $query, array $params = []): bool
    {
        $stmt = self::connect()->prepare($query);
        return $stmt->execute($params);
    }

    public static function delete(string $query, array $params = []): bool
    {
        $stmt = self::connect()->prepare($query);
        return $stmt->execute($params);
    }

    public static function raw(string $query): bool
    {
        return self::connect()->exec($query) !== false;
    }
}
