<?php
if ( $config['app']['DEBUG'] ) {
	error_reporting( E_ALL );
}


/*
|--------------------------------------------------------------------------
| DB Class
|--------------------------------------------------------------------------
|
| Here is where you can get everything related to accessing the Database
| example DB::query('SELECT * FROM `table_name`') will fetch all the results from `table_name`
| similarly you can call DB facade with any method.
|
*/


/**
 * Helps to load the view file
 *
 * @param $viewFile string  Name of view file you want to load
 * @param $params   array     Parameters you want to pass on to the viewFile
 */
function view( $viewFile, $params ) {
	#Check if viewFile exists
	if ( file_exists( 'views/' . $viewFile . '.php' ) ) {
		ob_start();
		$result = $params;
		require 'views/' . $viewFile . '.php';
		$content = ob_get_clean();
		require 'views/layouts/app.php';


		# if no vieFile found, show 404
	} else {
		ob_start();
		require 'views/404.php';
		$content = ob_get_clean();
		require 'views/layouts/app.php';
	}
}