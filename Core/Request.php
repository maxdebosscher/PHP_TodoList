<?php

namespace Core;

class Request
{
    /**
     * Gets either the url or the first part from the url.
     * 
     * @return string $path
     */
    public function getPath()
    {
        $path = $_SERVER["REQUEST_URI"] ?? "/";
        $position = strpos($path, "?");
        if ($position === false) {
            return $path;
        }

        return $path = substr($path, 0, $position);
    }

    /**
     * Gets the method from the url.
     * 
     * @return string
     */
    public function getMethod()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    /**
     * Cleans the parameters of a requested url.
     * 
     * @return array $params
     */
    public function getParams()
    {
        $params = [];
        if ($this->getMethod() === "get") {
            foreach ($_GET as $key => $value) {
                $params[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->getMethod() === "post") {
            foreach ($_POST as $key => $value) {
                $params[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $params;
    }
}