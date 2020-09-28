<?php

namespace Core;

class Application
{
    public static string $ROOT_DIR;
    public static Application $app;

    public Request $request;
    public Response $response;
    public Router $router;

    /**
     * Constructs the application.
     * 
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    /**
     * Runs the application.
     * 
     */
    public function run()
    {
        echo $this->router->resolve();
    }
}