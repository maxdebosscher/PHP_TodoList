<?php

namespace Controllers;

use Core\Controller;
use Core\Request;
use Controllers\TasklistController;

class ViewController extends Controller
{
    /**
     * Returns the index view.
     * 
     */
    public function index()
    {
        $params = TasklistController::index();

        return $this->render("index", $params);
    }
}