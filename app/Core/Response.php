<?php
namespace App\Core;

class Response
{
    private int $statusCode = 200;
    private array $headers = [];

    public function status(int $code): self
    {
        $this->statusCode = $code;
        http_response_code($code);
        return $this;
    }

    public function withHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        header("{$name}: {$value}");
        return $this;
    }

    public function json(array $data, int $statusCode = 200): void
    {
        $this->status($statusCode);
        $this->withHeader('Content-Type', 'application/json; charset=utf-8');
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function redirect(string $url, int $statusCode = 302): void
    {
        $this->status($statusCode);
        $this->withHeader('Location', $url);
        exit;
    }

    public function view(string $viewPath, array $data = [], ?string $layout = 'header'): void
    {
        extract($data);
        $contentFile = VIEWS_PATH . '/' . ltrim($viewPath, '/') . '.php';

        if (!file_exists($contentFile)) {
            $this->status(404);
            $contentFile = VIEWS_PATH . '/errors/404.php';
        }

        if ($layout) {
            require VIEWS_PATH . '/layouts/header.php';
            require $contentFile;
            require VIEWS_PATH . '/layouts/footer.php';
        } else {
            require $contentFile;
        }
        exit;
    }
}
