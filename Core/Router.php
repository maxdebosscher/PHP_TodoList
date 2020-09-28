<?php

namespace Core;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * Constructs the router.
     * 
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Adds a get route to the router's $routes array.
     * 
     * @param string $path
     * @param callback $callback
     */
    public function get($path, $callback)
    {
        $this->routes["get"][$path] = $callback;
    }

    /**
     * Adds a post route to the router's $routes array.
     * 
     * @param string $path
     * @param callback $callback
     */
    public function post($path, $callback)
    {
        $this->routes["post"][$path] = $callback;
    }

    /**
     * Decides how a route should be returned.
     * 
     * @return mixed
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback, $this->request);
    }

    /**
     * Renders a view with parameters.
     * 
     * @param string $view
     * @param array $params
     * 
     * @return string
     */
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace("{{ content }}", $viewContent, $layoutContent);
    }

    /**
     * Renders a view.
     * 
     * @param string $viewContent
     * 
     * @return string
     */
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();

        return str_replace("{{ content }}", $viewContent, $layoutContent);
    }

    /**
     * Returns layout contents.
     * 
     * @return string
     */
    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";

        return ob_get_clean();
    }

    /**
     * Returns view contents.
     * 
     * @param string $view
     * @param array $params
     * 
     * @return string
     */
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";

        return ob_get_clean();
    }
}