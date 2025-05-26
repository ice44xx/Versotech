<?php

namespace App\Models;

class User
{
    public static function all(): array
    {
        $users = Database::select("SELECT * FROM users");

        foreach ($users as &$user) {
            $user['colors'] = self::getColors($user['id']);
        }

        return $users;
    }

    public static function find(int $id): ?array
    {
        $user = Database::selectOne("SELECT * FROM users WHERE id = ?", [$id]);

        if (!$user) {
            return null;
        }

        $user['colors'] = self::getColors($id);
        return $user;
    }

    public static function create(string $name, string $email, array $colorIds = []): int
    {
        $id = Database::insert("INSERT INTO users (name, email) VALUES (?, ?)", [$name, $email]);

        if ($id && $colorIds) {
            self::syncColors($id, $colorIds);
        }

        return $id;
    }

    public static function update(int $id, string $name, string $email, array $colorIds = []): bool
    {
        $updated = Database::update("UPDATE users SET name = ?, email = ? WHERE id = ?", [$name, $email, $id]);

        if ($updated) {
            self::syncColors($id, $colorIds);
        }

        return $updated;
    }

    public static function delete(int $id): bool
    {
        Database::delete("DELETE FROM user_colors WHERE user_id = ?", [$id]);

        return Database::delete("DELETE FROM users WHERE id = ?", [$id]);
    }

    private static function getColors(int $userId): array
    {
        $rows = Database::select("
            SELECT c.name FROM colors c
            JOIN user_colors uc ON c.id = uc.color_id
            WHERE uc.user_id = ?", [$userId]);
        return array_column($rows, 'name');
    }

    private static function syncColors(int $userId, array $colorIds): void
    {
        Database::delete("DELETE FROM user_colors WHERE user_id = ?", [$userId]);

        foreach ($colorIds as $colorId) {
            Database::insert("INSERT INTO user_colors (user_id, color_id) VALUES (?, ?)", [$userId, $colorId]);
        }
    }
}
