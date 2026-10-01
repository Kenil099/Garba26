<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Services\AuthService;
use App\Models\User;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->authService = new AuthService();
    }

    public function showLogin(): void
    {
        if (Auth::check()) {
            $this->redirect('/');
        }
        $this->render('auth/login', [
            'title' => 'Sign In to Garba26',
        ]);
    }

    public function login(): void
    {
        $email = $this->request->input('email', '');
        $password = $this->request->input('password', '');

        $result = $this->authService->login($email, $password);

        if ($result['success']) {
            if ($this->request->isAjax()) {
                $this->json(['success' => true, 'redirect' => '/']);
            }
            Session::flash('success', 'Welcome back to Garba26!');
            $this->redirect('/');
        } else {
            if ($this->request->isAjax()) {
                $this->json(['success' => false, 'message' => $result['message']], 401);
            }
            Session::flash('error', $result['message']);
            $this->redirect('/login');
        }
    }

    public function showRegister(): void
    {
        if (Auth::check()) {
            $this->redirect('/');
        }
        $this->render('auth/register', [
            'title' => 'Create Your Garba26 Account',
        ]);
    }

    public function register(): void
    {
        $this->validate($this->request->all(), [
            'name'     => 'required|min:2',
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $result = $this->authService->register($this->request->all());

        if ($result['success']) {
            if ($this->request->isAjax()) {
                $this->json(['success' => true, 'redirect' => '/']);
            }
            Session::flash('success', 'Account created successfully! Welcome to Garba26.');
            $this->redirect('/');
        } else {
            if ($this->request->isAjax()) {
                $this->json(['success' => false, 'message' => $result['message']], 400);
            }
            Session::flash('error', $result['message']);
            $this->redirect('/register');
        }
    }

    public function logout(): void
    {
        Auth::logout();
        Session::flash('success', 'You have been signed out.');
        $this->redirect('/');
    }

    public function showForgotPassword(): void
    {
        $this->render('auth/forgot-password', [
            'title' => 'Reset Your Password - Garba26',
        ]);
    }

    public function resetPassword(): void
    {
        Session::flash('success', 'If this email exists in our records, a reset link has been dispatched.');
        $this->redirect('/login');
    }

    public function verifyEmail(): void
    {
        $this->render('auth/verify-email', [
            'title' => 'Email Verification - Garba26',
        ]);
    }
}
