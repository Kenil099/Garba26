<?php
namespace App\Middleware;

use App\Core\Auth;
use App\Core\Middleware;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;

class AuthMiddleware extends Middleware
{
    public function handle(Request $request, Response $response): void
    {
        if (!Auth::check()) {
            if ($request->isAjax()) {
                $response->json(['success' => false, 'message' => 'Unauthorized action. Please sign in.'], 401);
            }
            Session::flash('error', 'You must log in to access this feature.');
            $response->redirect('/login');
        }
    }
}
