<?php
namespace App\Middleware;

use App\Core\Middleware;
use App\Core\Request;
use App\Core\Response;

class UserMiddleware extends Middleware
{
    public function handle(Request $request, Response $response): void
    {
        // Standard user lifecycle check
    }
}
