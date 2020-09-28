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
}