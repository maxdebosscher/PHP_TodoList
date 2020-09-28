<?php

require_once __DIR__."/../autoload.php";

use Core\Application;
use Controllers\ViewController;
use Controllers\TaskController;
use Controllers\TasklistController;

/**
 * Bootstrap the Application.
 * 
 */
$app = new Application(dirname(__DIR__));

/**
 * Assign routes to the application.
 * 
 */
$app->router->get("/", [ViewController::class, "index"]);

$app->router->post("/task-store", [TaskController::class, "store"]);
$app->router->post("/task-update", [TaskController::class, "update"]);
$app->router->post("/task-destroy", [TaskController::class, "destroy"]);

$app->router->post("/tasklist-store", [TasklistController::class, "store"]);
$app->router->post("/tasklist-update", [TasklistController::class, "update"]);
$app->router->post("/tasklist-destroy", [TasklistController::class, "destroy"]);

/**
 * Run the application.
 * 
 */
$app->run();