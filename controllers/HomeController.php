<?php

/**
 * Project: cb_test
 * Author: gopalindians <gopalindians@gmail.com>
 * Date: 06-12-2017
 * Time: 03:39
 * Link:
 */

/**
 * Class HomeController
 */
class HomeController {


	/**
	 * @var
	 */
	private $firstName;

	/**
	 * @var
	 */
	private $lastName;

	/**
	 * @var
	 */
	private $streetName;

	/**
	 * @var
	 */
	private $cityName;

	/**
	 * @var
	 */
	private $zipCode;

	/**
	 * @var
	 */
	private $state;

	/**
	 * @var
	 */
	private $phone;

	/**
	 * @var
	 */
	private $email;


	/**
	 * @var
	 */
	private $skillCat1;

	/**
	 * @var
	 */
	private $skillCat2;

	/**
	 * @var
	 */
	private $skillCat3;

	/**
	 * @var
	 */
	private $skillCat4;

	/**
	 * @var array
	 */
	private $errors = [];

	/**
	 *
	 */
	public function index() {
		view( 'indexView', [] );
	}


	/**
	 *
	 */
	public function postUserForm() {

		$this->firstName  = isset( $_POST['first_name'] ) ? $_POST['first_name'] : '';
		$this->lastName   = isset( $_POST['last_name'] ) ? $_POST['last_name'] : '';

		$this->streetName = isset( $_POST['street_name'] ) ? $_POST['street_name'] : '';
		$this->cityName   = isset( $_POST['city_name'] ) ? $_POST['city_name'] : '';
		$this->zipCode    = (int)isset( $_POST['zip_code'] ) ? $_POST['zip_code'] : '';
		$this->state      = isset( $_POST['state'] ) ? $_POST['state'] : '';

		$this->phone      = (int)isset( $_POST['phone'] ) ? $_POST['phone'] : '';
		$this->email      = isset( $_POST['email'] ) ? $_POST['email'] : '';
		$this->skillCat1  = isset( $_POST['skill'][1][1] ) ? $_POST['skill'][1][1] : '';
		$this->skillCat2  = isset( $_POST['skill'][2][2] ) ? $_POST['skill'][2][2] : '';
		$this->skillCat3  = isset( $_POST['skill'][3][3] ) ? $_POST['skill'][3][3] : '';
		$this->skillCat4  = isset( $_POST['skill'][4][4] ) ? $_POST['skill'][4][4] : '';

		if ( $this->firstName === '' ) {
			$this->errors[] = 'First Name cannot be empty';
		} elseif ( strlen( $this->firstName ) > 50 ) {
			$this->errors[] = 'First Name is too long, max limit is 50';
		}

		if ( $this->lastName === '' ) {
			$this->errors[] = 'Last Name cannot be empty';
		} elseif ( strlen( $this->lastName ) > 50 ) {
			$this->errors[] = 'Last Name is too long, max limit is 50';
		}

		if ( $this->streetName === '' ) {
			$this->errors[] = 'Street Name cannot be empty';
		} elseif ( strlen( $this->streetName ) > 50 ) {
			$this->errors[] = 'Street Name is too long, max limit is 50';
		}


		if ( $this->cityName === '' ) {
			$this->errors[] = 'City Name cannot be empty';
		} elseif ( strlen( $this->cityName ) > 50 ) {
			$this->errors[] = 'City Name is too long, max limit is 50';
		}

		if ( $this->zipCode === '' ) {
			$this->errors[] = 'Zip code cannot be empty';
		} elseif ( strlen( $this->zipCode ) > 10 ) {
			$this->errors[] = 'Zip code is too long, max limit is 10';
		}

		if ( $this->state === '' ) {
			$this->errors[] = 'State cannot be empty';
		} elseif ( strlen( $this->state ) > 20 ) {
			$this->errors[] = 'State is too long, max limit is 20';
		}


		if ( $this->phone === '' ) {
			$this->errors[] = 'Phone cannot be empty';
		} elseif ( strlen( $this->phone ) > 15 ) {
			$this->errors[] = 'Phone is too long, max limit is 15';
		}


		if ( $this->email === '' ) {
			$this->errors[] = 'Email be empty';
		} elseif ( ! filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ) {
			$this->errors[] = 'Email is not valid ';
		} elseif ( strlen( $this->email ) > 100 ) {
			$this->errors[] = 'Email is too long, max limit is 100';
		}


		if ( $this->skillCat1 === '' ) {
			$this->errors[] = 'Scripting languages cannot be empty';
		} elseif ( strlen( $this->skillCat1 ) > 50 ) {
			$this->errors[] = 'Scripting languages is too long';
		}


		if ( $this->skillCat2 === '' ) {
			$this->errors[] = 'Other languages cannot be empty';
		} elseif ( strlen( $this->skillCat2 ) > 50 ) {
			$this->errors[] = 'Other languages is too long';
		}

		if ( $this->skillCat3 === '' ) {
			$this->errors[] = 'Databases cannot be empty';
		} elseif ( strlen( $this->skillCat3 ) > 50 ) {
			$this->errors[] = 'Databases is too long';
		}

		if ( $this->skillCat4 === '' ) {
			$this->errors[] = 'Personal skills cannot be empty';
		} elseif ( strlen( $this->skillCat4 ) > 50 ) {
			$this->errors[] = 'Personal skills is too long';
		}


		if ( count( $this->errors ) > 1 ) {
			header( 'Location:' . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) );
		} else {

			$date = date( 'Y-m-d h:i:s' );

			$result = DB::query(
				'INSERT INTO  users (first_name, last_name, street, city, zip, state, phone, email,created_at)
VALUES (\'' . $this->firstName . '\',\'' . $this->lastName . '\',\'' . $this->streetName . '\',\'' . $this->cityName . '\',\'' . $this->zipCode . '\',\'' . $this->state . '\',\'' . $this->phone . '\',\'' . $this->email . '\',\'' . $date . '\')' );


			if ( count( $result ) == 0 ) {

				$to      = $this->email;
				$subject = 'Submitted: Thanks for filling the form';
				$message = "Hello $this->firstName, your information is saved successfully, Thanks //:" . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' );
				$headers = 'From: gopalindians@gmail.com' . "\r\n" .
				           'Reply-To: gopalindians@gmail.com' . "\r\n" .
				           'Content-type: text/html; charset=utf-8' . "\r\n" .
				           'MIME-Version: 1.0' . "\r\n" .
				           'X-Mailer: PHP/' . PHP_VERSION;

				mail( $to, $this->email, $subject, $message, $headers );

				flash( 'success', 'Saved successfully' );
				header( 'Location:' . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' ) );
			}
		}

	}
}