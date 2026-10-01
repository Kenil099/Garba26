<?php
namespace App\Core;

class Controller
{
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    protected function render(string $view, array $data = [], ?string $layout = 'header'): void
    {
        $data['authUser'] = Auth::user();
        $data['siteName'] = SITE_NAME;
        $this->response->view($view, $data, $layout);
    }

    protected function json(array $data, int $status = 200): void
    {
        $this->response->json($data, $status);
    }

    protected function redirect(string $url): void
    {
        $this->response->redirect($url);
    }

    protected function validate(array $data, array $rules): array
    {
        $validator = new Validator($data, $rules);
        if (!$validator->passes()) {
            if ($this->request->isAjax()) {
                $this->json(['success' => false, 'errors' => $validator->errors()], 422);
            } else {
                Session::flash('errors', $validator->errors());
                Session::flash('old', $data);
                $this->redirect($_SERVER['HTTP_REFERER'] ?? '/');
            }
        }
        return $data;
    }
}
