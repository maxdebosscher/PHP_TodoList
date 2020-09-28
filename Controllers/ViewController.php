<?php

namespace Controllers;

use Core\Application;
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
        $tasklists = TasklistController::index();

        return $this->render("index", $tasklists);
    }
}