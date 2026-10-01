<?php
namespace App\Core;

use App\Models\User;

class Auth
{
    public static function login(array $user): void
    {
        Session::start();
        // Remove password hash from session storage
        unset($user['password']);
        Session::set('user', $user);
        Session::set('user_id', $user['id']);
        Session::set('user_role', $user['role'] ?? 'user');
    }

    public static function logout(): void
    {
        Session::remove('user');
        Session::remove('user_id');
        Session::remove('user_role');
        Session::destroy();
    }

    public static function check(): bool
    {
        return Session::has('user_id');
    }

    public static function id(): ?int
    {
        return Session::get('user_id');
    }

    public static function user(): ?array
    {
        return Session::get('user');
    }

    public static function role(): string
    {
        return Session::get('user_role', 'guest');
    }

    public static function isAdmin(): bool
    {
        return self::role() === 'admin';
    }

    public static function attempt(string $email, string $password): bool
    {
        $user = User::findByEmail($email);
        if (!$user) {
            return false;
        }
        if (password_verify($password, $user['password'])) {
            self::login($user);
            return true;
        }
        return false;
    }

    public static function hashPassword(string $plain): string
    {
        return password_hash($plain, PASSWORD_BCRYPT);
    }
}
