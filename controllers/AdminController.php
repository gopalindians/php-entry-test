<?php
/**
 * Project: cb_test
 * Author: gopalindians <gopalindians@gmail.com>
 * Date: 09-12-2017
 * Time: 02:25
 * Link:
 */

/**
 * To handle Admin related things
 * Class AdminController
 */
class AdminController {

	/**
	 * @var string
	 */
	private $userName;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * To store errors
	 *
	 * @var array
	 */
	private $errors = [];

	/**
	 * Default admin view
	 */
	public function index() {
		if ( ( isset( $_SESSION['user_name'] ) && $_SESSION['user_name'] == Config::get( 'app.ADMIN_USER_NAME' ) ) && ( isset( $_SESSION['password'] ) && $_SESSION['password'] == Config::get( 'app.ADMIN_PASSWORD' ) ) ) {
			header( 'Location:' . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) . 'admin/dashboard' );
		} else {
			view( 'adminLogin', [] );
		}
	}


	/**
	 * Method to handle the login data
	 */
	public function postLogin() {
		$this->userName = isset( $_POST['user_name'] ) ? $_POST['user_name'] : '';
		$this->password = isset( $_POST['password'] ) ? $_POST['password'] : '';

		if ( $this->userName === '' ) {
			$this->errors[] = 'User name cannot be empty';
		} elseif ( $this->userName !== Config::get( 'app.ADMIN_USER_NAME' ) ) {
			$this->errors[] = 'User name is invalid';
		}

		if ( $this->password === '' ) {
			$this->errors[] = 'Password cannot be empty';
		} elseif ( $this->password !== Config::get( 'app.ADMIN_PASSWORD' ) ) {
			$this->errors[] = 'Password is invalid';
		}

		if ( count( $this->errors ) > 0 ) {
			view( 'adminLogin', $this->errors );
		} else {
			session_start();
			$_SESSION['user_name'] = Config::get( 'app.ADMIN_USER_NAME' );
			$_SESSION['password']  = Config::get( 'app.ADMIN_PASSWORD' );
			header( 'Location:' . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) . 'admin/dashboard' );
		}

	}

	/**
	 * Method to get the admin dashboard
	 */
	public function getDash() {

		if ( isset( $_SESSION['user_name'] ) && $_SESSION['user_name'] == Config::get( 'app.ADMIN_USER_NAME' ) && isset( $_SESSION['password'] ) && $_SESSION['password'] == Config::get( 'app.ADMIN_PASSWORD' ) ) {
			view( 'adminDash', [] );
		} else {
			flash( 'warning', 'You are not authorized to see this', 'warning' );
			header( 'Location:' . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) . 'admin' );
		}

	}

	/**
	 * Method to logout the admin from the dashboard
	 */
	public function logout() {
		if ( $_SESSION['user_name'] == Config::get( 'app.ADMIN_USER_NAME' ) && $_SESSION['password'] == Config::get( 'app.ADMIN_PASSWORD' ) ) {
			unset( $_SESSION['user_name'], $_SESSION['password'] );
			header( 'Location:' . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) . 'admin' );
		}
	}


	/**
	 * Method to see detail page of user
	 */
	public function postUserDetail() {

		if ( $_SESSION['user_name'] == Config::get( 'app.ADMIN_USER_NAME' ) && $_SESSION['password'] == Config::get( 'app.ADMIN_PASSWORD' ) ) {


			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

				$user_id = $_POST['user_id'];
				$result  = DB::query( 'SELECT * FROM users WHERE users.id=' . $user_id );


				foreach ( $result as $key => $item ) {

					$skills = DB::query( 'SELECT skill_name FROM  skills WHERE user_id=' . (int) $item['id'] );
					foreach ( $skills as $skill_key => $skill ) {
						$result[ $key ][ 'skill_' . ++ $skill_key . '_name' ] = $skill['skill_name'];
					}


					$skill_categories = DB::query( 'SELECT sc_name,sc_evaluation FROM  skill_categories WHERE user_id=' . $item['id'] );
					foreach ( $skill_categories as $sc_key => $skillCategory ) {
						$k = $sc_key;
						++ $k;
						++ $sc_key;
						$result[ $key ][ 'skill_category_' . $k . '_name' ]            = $skillCategory['sc_name'];
						$result[ $key ][ 'skill_category_' . $sc_key . '_evaluation' ] = $skillCategory['sc_evaluation'];

					}
				}

				view( 'admin.userDetail', $result );
			} else {
				header( 'Location:' . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) . 'admin' );
			}
		} else {
			flash( 'warning', 'You are not authorized to see this', 'warning' );
			header( 'Location:' . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) . 'admin' );
		}
	}


	public function getMapAllUsers() {

		if ( isset( $_SESSION['user_name'] ) && $_SESSION['user_name'] == Config::get( 'app.ADMIN_USER_NAME' ) && isset( $_SESSION['password'] ) && $_SESSION['password'] == Config::get( 'app.ADMIN_PASSWORD' ) ) {
			$allUsers = DB::query( 'SELECT * FROM users' );
			foreach ( $allUsers as $key => $user ) {
				$allUsers[ $key ]['skills']         = DB::query( 'SELECT * FROM skills WHERE user_id=' . $user['id'] );
				$allUsers[ $key ]['skill_category'] = DB::query( 'SELECT * FROM skill_categories WHERE user_id=' . $user['id'] );
			}
			view( 'adminMapAllUsers', $allUsers );
		} else {
			flash( 'warning', 'You are not authorized to see this', 'warning' );
			header( 'Location:' . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) . 'admin' );
		}
	}
}