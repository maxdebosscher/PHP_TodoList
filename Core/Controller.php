<?php

namespace Core;

class Controller
{
    /**
     * Renders a view.
     * 
     * @param string $view
     * @param array $params
     */
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}