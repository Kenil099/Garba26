<?php
namespace App\Middleware;

use App\Core\Auth;
use App\Core\Middleware;
use App\Core\Request;
use App\Core\Response;

class AdminMiddleware extends Middleware
{
    public function handle(Request $request, Response $response): void
    {
        if (!Auth::check() || !Auth::isAdmin()) {
            if ($request->isAjax()) {
                $response->json(['success' => false, 'message' => 'Forbidden. Admin privileges required.'], 403);
            }
            $response->status(403)->view('errors/403', ['title' => 'Forbidden Access - Garba26']);
        }
    }
}
