<?php

namespace Controllers;

use Core\Application;
use Core\Controller;
use Core\Request;

class ViewController extends Controller
{
    /**
     * Returns the index view.
     * 
     */
    public function index()
    {
        return $this->render("index");
    }

    /**
     * Returns the index view with post data.
     * 
     * @param Request $request
     */
    public function postIndex(Request $request)
    {
        $params = $request->getParams();

        return $this->render("index", $params);
    }
}