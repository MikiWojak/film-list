<?php

session_start();

class AppController {
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'. $template.'.php';
        $notFoundPath = 'public/views/404.php';

        $templateToLoadPath = file_exists($templatePath) ? $templatePath : $notFoundPath;

        // Extract variables
        extract($variables);

        ob_start();
        include $templateToLoadPath;
        $output = ob_get_clean();

        print $output;
    }
}
