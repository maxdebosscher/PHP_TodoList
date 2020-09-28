<?php

namespace Core;

class Response
{
    /**
     * Sets the statuscode of a response.
     * 
     * @param int $code
     */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}