<?php

namespace Controllers;

use Core\Controller;
use Core\Request;
use Controllers\TasklistController;
use Controllers\StatusController;

class ViewController extends Controller
{
    /**
     * Returns the index view.
     * 
     */
    public function index()
    {
        $sort = "asc";
        if (isset($_GET["sort"])) {
            if ($_GET["sort"] === "asc") {
                $sort = "desc";
            }
        }

        $params = [TasklistController::index(), $sort, StatusController::index()];

        return $this->render("index", $params);
    }
}