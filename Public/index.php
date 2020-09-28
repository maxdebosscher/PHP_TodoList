<?php

require_once __DIR__."/../autoload.php";

use Core\Application;

$app = new Application(dirname(__DIR__));

$app->run();