<?php

namespace tomtroc\services;

class SessionService
{
    public function __construct(string $savePath, string $sessionName)
    {
        session_save_path($savePath);

        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            // 'domain' => '',
            'domain' => "." . $_SERVER["SERVER_NAME"],
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        session_name($sessionName);
    }

    /**
     * Destroy session
     */
    public function destroy(): SessionService
    {
        unset($_SESSION);
        session_destroy();

        return $this;
    }

    /**
     * Regenerate session: destroy, start, regenerateId
     */
    public function regenerate(): SessionService
    {
        $this->destroy()
            ->start()
            ->regenerateId();


        return $this;
    }

    /**
     * Regenerate session ID
     */
    public function regenerateId(): SessionService
    {
        session_regenerate_id();

        return $this;
    }

    /**
     * Start session
     * 
     * 
     */
    public function start(): SessionService
    {
        session_start();

        return $this;
    }

    /**
     * Set connection status
     */
    public function setIsConnected(bool $isConneted = false): SessionService
    {
        $_SESSION["isConnected"] = $isConneted;

        return $this;
    }

    /**
     * Get connection status
     */
    public function getIsConnected(): bool
    {
        return $_SESSION["isConnected"] ?? false;
    }

    /**
     * Set the request URI before login
     */
    public function setRequestURI(string $requestURI): SessionService
    {
        $_SESSION["requestURI"] = trim($requestURI, "/");

        return $this;
    }

    /**
     * Get the request URI before login
     */
    public function getRequestURI(): string
    {
        return $_SESSION["requestURI"] ?? "";
    }

    /**
     * Set a session value by key
     */
    public function setValue($key, $value): SessionService
    {
        $_SESSION[$key] = $value;

        return $this;
    }

    /**
     * Get a session value by key
     */
    public function getValue($key)
    {
        return $_SESSION[$key] ?? "";
    }
}
