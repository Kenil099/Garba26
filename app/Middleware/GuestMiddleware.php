<?php
namespace App\Middleware;

use App\Core\Auth;
use App\Core\Middleware;
use App\Core\Request;
use App\Core\Response;

class GuestMiddleware extends Middleware
{
    public function handle(Request $request, Response $response): void
    {
        if (Auth::check()) {
            $response->redirect('/');
        }
    }
}
