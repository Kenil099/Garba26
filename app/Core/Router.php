<?php
namespace App\Core;

class Router
{
    private array $routes = [];
    private Request $request;
    private Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $handler, array $middleware = []): self
    {
        $this->addRoute('GET', $path, $handler, $middleware);
        return $this;
    }

    public function post(string $path, $handler, array $middleware = []): self
    {
        $this->addRoute('POST', $path, $handler, $middleware);
        return $this;
    }

    public function put(string $path, $handler, array $middleware = []): self
    {
        $this->addRoute('PUT', $path, $handler, $middleware);
        return $this;
    }

    public function delete(string $path, $handler, array $middleware = []): self
    {
        $this->addRoute('DELETE', $path, $handler, $middleware);
        return $this;
    }

    private function addRoute(string $method, string $path, $handler, array $middleware): void
    {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = "#^" . $pattern . "$#";

        $this->routes[] = [
            'method'     => $method,
            'path'       => $path,
            'pattern'    => $pattern,
            'handler'    => $handler,
            'middleware' => $middleware,
        ];
    }

    public function resolve(): void
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $path, $matches)) {
                $params = [];
                foreach ($matches as $key => $val) {
                    if (!is_int($key)) {
                        $params[$key] = $val;
                    }
                }

                // Execute route middleware
                foreach ($route['middleware'] as $mw) {
                    $mwInstance = new $mw();
                    $mwInstance->handle($this->request, $this->response);
                }

                $handler = $route['handler'];

                if (is_callable($handler)) {
                    call_user_func($handler, $this->request, $this->response, $params);
                    return;
                }

                if (is_array($handler) && count($handler) === 2) {
                    [$controllerClass, $action] = $handler;
                    if (class_exists($controllerClass)) {
                        $controller = new $controllerClass($this->request, $this->response);
                        if (method_exists($controller, $action)) {
                            call_user_func([$controller, $action], $params);
                            return;
                        }
                    }
                }
            }
        }

        // 404 handler
        if ($this->request->isAjax() || str_starts_with($path, '/api/')) {
            $this->response->json(['error' => 'Endpoint not found', 'path' => $path], 404);
        } else {
            $this->response->status(404)->view('errors/404', ['title' => 'Page Not Found - Garba26']);
        }
    }
}
