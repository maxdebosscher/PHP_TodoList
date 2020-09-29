<?php

namespace Controllers;

use Core\Controller;
use Core\Database;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public static function index()
    {
        $status = Database::all("status");
        
        return $status;
    }
}