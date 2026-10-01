<?php
namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected static string $table = 'users';

    public static function findByEmail(string $email): ?array
    {
        return static::firstWhere('email', strtolower(trim($email)));
    }

    public static function getStats(): array
    {
        return [
            'total_users' => static::count(),
            'active_users' => static::count('is_active = 1'),
        ];
    }
}
