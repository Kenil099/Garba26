<?php
namespace App\Services;

use App\Core\Auth;
use App\Models\User;

class AuthService
{
    public function register(array $data): array
    {
        $existing = User::findByEmail($data['email']);
        if ($existing) {
            return ['success' => false, 'message' => 'Email is already registered.'];
        }

        $userId = User::create([
            'name'     => trim($data['name']),
            'email'    => strtolower(trim($data['email'])),
            'password' => Auth::hashPassword($data['password']),
            'role'     => 'user',
            'avatar'   => '/assets/images/default-avatar.png',
        ]);

        $user = User::find($userId);
        Auth::login($user);

        return ['success' => true, 'user' => $user];
    }

    public function login(string $email, string $password): array
    {
        if (Auth::attempt($email, $password)) {
            return ['success' => true, 'user' => Auth::user()];
        }
        return ['success' => false, 'message' => 'Invalid email or password.'];
    }
}
