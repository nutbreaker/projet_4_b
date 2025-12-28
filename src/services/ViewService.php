<?php

namespace tomtroc\services;

/**
 * Service for rendering views within a base template.
 */
class ViewService
{
    private $path;
    private $baseTemplate;

    public function __construct(string $path, string $baseTemplate)
    {
        $this->path = $path;
        $this->baseTemplate = $this->addExtension($baseTemplate);
    }

    /**
     * Renders a view template with optional parameters and HTTP status code.
     *
     * @param string $templateName name of the template file to be rendered
     * @param array $params to be made available in the template scope
     * @param int $statusCode the HTTP response status code
     *
     * @return void
     *
     * @example
     * // Render 'users' template with default 200 OK status
     * $this->view('users');
     *
     * // Render 'profile' template with custom parameters
     * $this->view('profile', ['user' => $userObject]);
     *
     * // Render 'error' template with 404 Not Found status
     * $this->view('error', [], 404);
     */
    public function view(string $templateName, array $params = [], int $statusCode = 200): void
    {
        http_response_code($statusCode);

        // implicitly available in the template
        $template = $this->addExtension($this->path . $templateName);

        require_once($this->path . $this->baseTemplate);
    }

    /**
     * Ensures the template filename has a .php extension.
     *
     * @param string $template the original template filename
     * 
     * @return string the template filename with .php extension
     *
     * @example
     * addExtension('view')       // Returns 'view.php'
     * addExtension('view.php')   // Returns 'view.php' (unchanged)
     */
    private function addExtension(string $template): string
    {
        return str_ends_with($template, '.php') ? $template : $template . '.php';
    }
}
