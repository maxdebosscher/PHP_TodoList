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
        $sort = "asc";

        if (isset($_GET["sort"])) {
            if ($_GET["sort"] === "asc") {
                $sort = "desc";
            }
        }

        $params = [TasklistController::index(), $sort];

        return $this->render("index", $params);
    }
}