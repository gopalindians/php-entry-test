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

if (file_exists(__DIR__ . '/lib/session.php')) {
    require_once __DIR__ . '/lib/session.php';
} else {
    try {
        throw new Exception('/lib/session.php file not found');
    } catch (Exception $exception) {
        $error = "FILE: <span style='background: red' >" . __DIR__ . "/lib/session.php</span> Not found </br>";
        $error .= "See <span  <span style='background: greenyellow'>" . __FILE__ . "</span></br>";
        $error .= "Line: " . $exception->getLine() . "</br>";
        echo $error;
    }
}

if (file_exists(__DIR__ . '/config/config.php')) {
    require_once __DIR__ . '/config/config.php';
} else {
    try {
        throw new Exception('/config/config.php file not found');
    } catch (Exception $exception) {

        $error = "FILE: <span style='background: red' >" . __DIR__ . "/config/config.php</span> Not found </br>";
        $error .= "See <span  <span style='background: greenyellow'>" . __FILE__ . "</span></br>";
        $error .= "Line: " . $exception->getLine() . "</br>";
        echo $error;

    }
}


if (file_exists(__DIR__ . '/lib/helper.php')) {
    require_once __DIR__ . '/lib/helper.php';
} else {
    try {
        throw new Exception('/lib/helper.php file not found');
    } catch (Exception $exception) {

        $error = "FILE: <span style='background: red' >" . __DIR__ . "/lib/helper.php</span> Not found </br>";
        $error .= "See <span  <span style='background: greenyellow'>" . __FILE__ . "</span></br>";
        $error .= "Line: " . $exception->getLine() . "</br>";
        echo $error;

    }
}

if (file_exists(__DIR__ . '/model/DB.php')) {
    require_once __DIR__ . '/model/DB.php';
} else {
    try {
        throw new Exception('/model/DB.php file not found');
    } catch (Exception $exception) {

        $error = "FILE: <span style='background: red' >" . __DIR__ . "/model/DB.php</span> Not found </br>";
        $error .= "See <span  <span style='background: greenyellow'>" . __FILE__ . "</span></br>";
        $error .= "Line: " . $exception->getLine() . "</br>";
        echo $error;

    }
}


if (file_exists(__DIR__ . '/lib/routes.php')) {
    require_once __DIR__ . '/lib/routes.php';
} else {
    try {
        throw new Exception('/lib/routes.php file not found');
    } catch (Exception $exception) {

        $error = "FILE: <span style='background: red' >" . __DIR__ . "/model/DB.php</span> Not found </br>";
        $error .= "See <span  <span style='background: greenyellow'>" . __FILE__ . "</span></br>";
        $error .= "Line: " . $exception->getLine() . "</br>";
        echo $error;

    }
}


if (file_exists(__DIR__ . '/lib/router_handler.php')) {
    require_once __DIR__ . '/lib/router_handler.php';
} else {
    try {
        throw new Exception('/lib/router_handler.php file not found');
    } catch (Exception $exception) {

        $error = "FILE: <span style='background: red' >" . __DIR__ . "/lib/router_handler.php</span> Not found </br>";
        $error .= "See <span  <span style='background: greenyellow'>" . __FILE__ . "</span></br>";
        $error .= "Line: " . $exception->getLine() . "</br>";
        echo $error;

    }
}