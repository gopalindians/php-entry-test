<?php defined( 'APP_VERSION' ) or die();

/*
|--------------------------------------------------------------------------
| Web Routes Handler
|--------------------------------------------------------------------------
|
| This file handles the logic behind the routes.php
*/

$path                           = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$config['app']['APP_EXTRA_URL'] = trim( $config['app']['APP_EXTRA_URL'], '/' );
$vanillaPath                    = trim( $path, '/' );
$vanillaPath                    = str_replace( [ $config['app']['APP_EXTRA_URL'], '//' ], '', $vanillaPath );
$vanillaPath                    = trim( $vanillaPath, '/' );

$allRoutes     = array_keys( $routePaths );
$vanillaRoutes = [];
$fixedRoutes   = '';

foreach ( $allRoutes as $k => $r ) {
	$r               = trim( $r, '/' );
	$vanillaRoutes[] = $r;
}


$matchedController = false;
if ( in_array( $vanillaPath, $vanillaRoutes, true ) ) {
	foreach ( $routePaths as $rpKey => $rpValue ) {
		$rpKey = trim( $rpKey, '/' );
		if ( $rpKey === $vanillaPath ) {
			$matchedController = $rpValue;
		}
	}

	list( $controller, $method ) = explode( '@', $matchedController );
	if ( file_exists( $config['app']['BASE_DIR'] . '/controllers/' . $controller . '.php' ) ) {
		require $config['app']['BASE_DIR'] . '/controllers/' . $controller . '.php';

		$obj          = new $controller();
		$classMethods = get_class_methods( $obj );

		foreach ( $classMethods as $classKey => $classMethod ) {
			if ( $classMethod === $method ) {
				echo $obj->$classMethod();
			}
		}

	} else {
		$error['message'] = 'The route  <i>' . $config['app']['APP_URL'] . $config['app']['APP_EXTRA_URL'] . "/$vanillaPath</i>  dont have valid controller see <em>routes.php</em>";
		ob_start();
		require $config['app']['BASE_DIR'] . '/views/404.php';
		$content = ob_get_clean();
		require $config['app']['BASE_DIR'] . '/views/layouts/app.php';
	}
} else {
	$error['message'] = 'The route  <i>' . $config['app']['APP_URL'] . $config['app']['APP_EXTRA_URL'] . "/$vanillaPath</i> is not available declare it in <em>routes.php</em>";
	ob_start();
	require_once $config['app']['BASE_DIR'] . '/views/404.php';
	$content = ob_get_clean();
	require_once $config['app']['BASE_DIR'] . '/views/layouts/app.php';
}