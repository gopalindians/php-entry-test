<?php
/*
|--------------------------------------------------------------------------
| Index file
|--------------------------------------------------------------------------
|
| This is the file that gets executed first
|
| Files that are includes are:
|  1 session        -  Handles the flash data(based on session) related logic
|  2 config         -  Contains the config array which stores constants like DB_USER_NAME, AP_KEY etc and also loads them as ENVIRONMENT variable
|  3 helper         -  Contains view method to load the vieFile accordingly
|  4 DB             -  Contains the class logic to connect the MySQL through PDO and also provide way to query the database
|  5 routes         -  Contains all the routes to the application
|  6 routes_handler -  Handles the logic behind routes matching
|
*/

require_once __DIR__ . '/lib/session.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/lib/helper.php';
require_once __DIR__ . '/model/DB.php';
require_once __DIR__ . '/lib/routes.php';
require_once __DIR__ . '/lib/router_handler.php';