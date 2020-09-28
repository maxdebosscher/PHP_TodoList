<?php

namespace Core;

class Application
{
    public static string $ROOT_DIR;
    public static Application $app;

    /**
     * Constructs the application.
     * 
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
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