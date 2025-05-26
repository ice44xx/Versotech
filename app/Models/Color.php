<?php

namespace App\Models;

class Color
{
    public static function all(): array
    {
        return Database::select("SELECT * FROM colors ORDER BY name");
    }

    public static function find(int $id): ?array
    {
        return Database::selectOne("SELECT * FROM colors WHERE id = ?", [$id]);
    }
}
