<?php

/*
|--------------------------------------------------------------------------
| Session
|--------------------------------------------------------------------------
|
| It helps in displaying flash messages using session
| It contains single flash() function which takes the parameter and displays the message accordingly
|
| How to use :
| 1 - declare   flash('name','message','CLASS') in controller
| 2 - use       flash('name') in viewFile
|
*/


if ( ! session_id() ) {
	session_start();
}

/**
 * Function to create and display error and success messages
 *
 * @param string $name    key name used to display the flash message
 * @param array  $message message to display
 * @param string $class   error,success,info etc
 */
function flash( $name = '', $message = [], $class = 'success' ) {

	if ( ! empty( $name ) ) {

		if ( ! empty( $message ) && empty( $_SESSION[ $name ] ) ) {
			if ( ! empty( $_SESSION[ $name ] ) ) {
				unset( $_SESSION[ $name ] );
			}
			$_SESSION[ $name ] = $message;
		} elseif ( ! empty( $_SESSION[ $name ] ) && empty( $message ) ) {

			if ( is_array( $message ) ) {

				$alert = '<div class="alert alert-' . $class . '" id="msg-flash" role="alert">';

				foreach ( $message as $item ) {
					$alert .= $_SESSION[ $message ][ $item ] . '</br>';
				}
				$alert .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

				echo $alert;
			} else {
				echo '<div class="alert alert-' . $class . '" id="msg-flash" role="alert">' . $_SESSION[ $name ] . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			}
			unset( $_SESSION[ $name ] );
		}
	}
}