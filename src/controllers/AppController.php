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
        // @TODO 404 page
        $output = 'File not found';
                
        if(file_exists($templatePath)){
            // Extract variables
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        
        print $output;
    }

    // @TODO Remove if not used
    protected function renderCss(string $template = null)
    {
        $templatePath = 'public/css/'.$template;
        // @TODO Not found
        $output = '';

        if(file_exists($templatePath)){
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }
}
