<?php
/**
 * Project: cb_test
 * Author: gopalindians <gopalindians@gmail.com>
 * Date: 06-12-2017
 * Time: 20:17
 * Link:
 */

/**
 * To handle Api related operations
 * Class ApiController
 */
class ApiController {


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
	 * @var
	 */
	private $skillCat1Rating;

	/**
	 * @var
	 */
	private $skillCat2Rating;

	/**
	 * @var
	 */
	private $skillCat3Rating;

	/**
	 * @var
	 */
	private $skillCat4Rating;


	/**
	 * @var array
	 */
	private $errors = [];

	/**
	 * To get the states in json format to load them in user form
	 *
	 * @return bool|string
	 */
	public function getStates() {
		header( 'Content-Type: application/json' );

		return file_get_contents( Config::get( 'app.BASE_DIR' ) . '/data/states.json' );
	}

	/**
	 * To get the Categories and skills in json format to load them in user form
	 *
	 * @return string
	 */
	public function getCategoriesAndSkills() {
		$skill_categories = DB::query( 'SELECT
                      codebook_for_categories.id         AS skill_category_id,
                      codebook_for_categories.category   AS skill_category_name,
                      codebook_for_categories.created_at AS skill_category_created_at
                  FROM codebook_for_categories' );


		foreach ( $skill_categories as $key => $skillCategory ) {
			$skill_category_id                  = (int) trim( $skillCategory['skill_category_id'] );
			$skill_categories[ $key ]['skills'] = DB::query( "SELECT
  								codebook_for_skills.id         AS skill_id,
                                codebook_for_skills.skill       AS skill_name,
                                codebook_for_skills.created_at AS skill_created_at
                          FROM codebook_for_skills WHERE codebook_for_skills.skill_category_id =  $skill_category_id" );
		}
		header( 'Content-Type: application/json' );

		return json_encode( $skill_categories );
	}


	/**
	 * get all users to show them on admin dashboard
	 *
	 * @return string
	 */
	public function getUsers() {
		$offset = 0;
		if ( isset( $_POST['offset'] ) ) {
			$offset = $_POST['offset'];
		}
		$result = DB::query( 'SELECT * FROM users ORDER BY created_at DESC LIMIT 5 OFFSET ' . $offset );
		header( 'Content-Type: application/json' );

		return json_encode( $result );
	}


	/**
	 * @return string
	 */
	public function getUser() {

		$request_body = file_get_contents( 'php://input' );
		$data         = json_decode( $request_body );
		$user_id      = $data->user_id;
		$result       = DB::query( 'SELECT * FROM users WHERE id=' . $user_id );
		header( 'Content-Type: application/json' );

		return json_encode( $result );

	}


	/**
	 * @return string
	 */
	public function postUserForm() {
		$this->firstName  = trim( isset( $_POST['first_name'] ) ? $_POST['first_name'] : '' );
		$this->lastName   = trim( isset( $_POST['last_name'] ) ? $_POST['last_name'] : '' );
		$this->streetName = trim( isset( $_POST['street_name'] ) ? $_POST['street_name'] : '' );
		$this->firstName  = trim( isset( $_POST['first_name'] ) ? $_POST['first_name'] : '' );
		$this->cityName   = trim( isset( $_POST['city_name'] ) ? $_POST['city_name'] : '' );
		$this->zipCode    = trim( isset( $_POST['zip_code'] ) ? $_POST['zip_code'] : '' );
		$this->state      = trim( isset( $_POST['state'] ) ? $_POST['state'] : '' );
		$this->phone      = trim( isset( $_POST['phone'] ) ? $_POST['phone'] : '' );
		$this->email      = trim( isset( $_POST['email'] ) ? $_POST['email'] : '' );

		$this->skillCat1       = trim( isset( $_POST['skill_1'] ) ? $_POST['skill_1'] : '' );
		$this->skillCat1Rating = trim( isset( $_POST['skill_1_rating'] ) ? $_POST['skill_1_rating'] : '' );

		$this->skillCat2       = trim( isset( $_POST['skill_2'] ) ? $_POST['skill_2'] : '' );
		$this->skillCat2Rating = trim( isset( $_POST['skill_2_rating'] ) ? $_POST['skill_2_rating'] : '' );

		$this->skillCat3       = trim( isset( $_POST['skill_3'] ) ? $_POST['skill_3'] : '' );
		$this->skillCat3Rating = trim( isset( $_POST['skill_3_rating'] ) ? $_POST['skill_3_rating'] : '' );

		$this->skillCat4       = trim( isset( $_POST['skill_4'] ) ? $_POST['skill_4'] : '' );
		$this->skillCat4Rating = trim( isset( $_POST['skill_4'] ) ? $_POST['skill_4_rating'] : '' );

		// first name
		if ( $this->firstName === '' ) {
			$response = $this->logError( 'First Name cannot be empty' );

			return $this->responseJson( $response );
		}
		if ( strlen( $this->firstName ) > 50 ) {
			$response = $this->logError( 'First Name is too long, max limit is 50' );

			return $this->responseJson( $response );
		}


		//last name
		if ( $this->lastName === '' ) {
			$response = $this->logError( 'Last Name cannot be empty' );

			return $this->responseJson( $response );
		}

		if ( strlen( $this->lastName ) > 50 ) {
			$response = $this->logError( 'Last Name is too long, max limit is 50' );

			return $this->responseJson( $response );
		}


		// Street Name
		if ( $this->streetName === '' ) {
			$response = $this->logError( 'Street Name cannot be empty' );

			return $this->responseJson( $response );
		}

		if ( strlen( $this->streetName ) > 50 ) {
			$response = $this->logError( 'Street Name is too long, max limit is 50' );

			return $this->responseJson( $response );

		}


		//city name
		if ( $this->cityName === '' ) {
			$response = $this->logError( 'City Name cannot be empty' );

			return $this->responseJson( $response );
		}

		if ( strlen( $this->cityName ) > 50 ) {
			$response = $this->logError( 'City Name is too long, max limit is 50' );

			return $this->responseJson( $response );
		}


		//zip code
		if ( $this->zipCode === '' ) {
			$response = $this->logError( 'Zip code cannot be empty' );

			return $this->responseJson( $response );
		}
		if ( strlen( $this->zipCode ) > 10 ) {
			$response = $this->logError( 'Zip code is too long, max limit is 10' );

			return $this->responseJson( $response );
		}


		//State
		if ( $this->state === '' ) {
			$response = $this->logError( 'State name cannot be empty' );

			return $this->responseJson( $response );
		}

		if ( strlen( $this->state ) > 20 ) {
			$response = $this->logError( 'State name is too long, max limit is 20' );

			return $this->responseJson( $response );
		}


		//Phone
		if ( $this->phone === '' ) {
			$response = $this->logError( 'Phone cannot be empty' );

			return $this->responseJson( $response );
		}
		if ( strlen( $this->phone ) > 15 ) {

			$response = $this->logError( 'Phone is too long, max limit is 15' );

			return $this->responseJson( $response );
		}


		//email
		if ( $this->email === '' ) {
			$response = $this->logError( 'Email be empty' );

			return $this->responseJson( $response );
		}
		if ( ! filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ) {
			$response = $this->logError( 'Email is not valid' );

			return $this->responseJson( $response );
		}


		if ( strlen( $this->email ) > 100 ) {
			$response = $this->logError( 'Email is too long, max limit is 100' );

			return $this->responseJson( $response );
		}


		//cat 1  Scripting languages
		if ( $this->skillCat1 === '' ) {
			$response = $this->logError( 'Scripting languages cannot be empty0' );

			return $this->responseJson( $response );
		}
		if ( strlen( $this->skillCat1 ) > 50 ) {
			$response = $this->logError( 'Scripting languages is too long' );

			return $this->responseJson( $response );
		}

		//cat 1  Scripting languages selected ratings
		if ( $this->skillCat1Rating === '' ) {
			$response = $this->logError( 'Scripting languages ratings cannot be empty' );

			return $this->responseJson( $response );
		}


		//cat 2  Other languages
		if ( $this->skillCat2 === '' ) {

			$response = $this->logError( 'Other languages cannot be empty' );

			return $this->responseJson( $response );
		}
		if ( strlen( $this->skillCat2 ) > 50 ) {
			$response = $this->logError( 'Other languages is too long' );

			return $this->responseJson( $response );
		}
		//cat 2  Other languages selected ratings
		if ( $this->skillCat2Rating === '' ) {
			$response = $this->logError( 'Other languages ratings cannot be empty' );

			return $this->responseJson( $response );
		}


		//cat 3 Databases
		if ( $this->skillCat3 === '' ) {
			$response = $this->logError( 'Databases cannot be empty' );

			return $this->responseJson( $response );
		}

		if ( strlen( $this->skillCat3 ) > 50 ) {
			$response = $this->logError( 'Databases is too long' );

			return $this->responseJson( $response );
		}

		//cat 3  Other Databases selected ratings
		if ( $this->skillCat3Rating === '' ) {
			$response = $this->logError( 'Databases ratings cannot be empty' );

			return $this->responseJson( $response );
		}


		//cat 4 Personal skills
		if ( $this->skillCat4 === '' ) {
			$response = $this->logError( 'Personal skills cannot be empty' );

			return $this->responseJson( $response );
		}
		if ( strlen( $this->skillCat4 ) > 50 ) {
			$response = $this->logError( 'Personal skills is too long' );

			return $this->responseJson( $response );
		}

		//cat 4  Personal skills selected ratings
		if ( $this->skillCat4Rating === '' ) {
			$response = $this->logError( 'Personal skills ratings cannot be empty' );

			return $this->responseJson( $response );
		}


		$date = date( 'Y-m-d h:i:s' );

		$result = DB::query(
			'INSERT INTO  users (
first_name, last_name,
 street, city, zip, state,
  phone, email,
  skill_category_1,skill_category_1_rating,
  skill_category_2,skill_category_2_rating,
  skill_category_3,skill_category_3_rating,
  skill_category_4,skill_category_4_rating,
  created_at)
VALUES (\''
			. $this->firstName . '\',\'' . $this->lastName
			. '\',\'' . $this->streetName . '\',\'' . $this->cityName . '\',\'' . $this->zipCode . '\',\'' . $this->state
			. '\',\'' . $this->phone . '\',\'' . $this->email
			. '\',\'' . $this->skillCat1 . '\',\'' . $this->skillCat1Rating
			. '\',\'' . $this->skillCat2 . '\',\'' . $this->skillCat2Rating
			. '\',\'' . $this->skillCat3 . '\',\'' . $this->skillCat3Rating
			. '\',\'' . $this->skillCat4 . '\',\'' . $this->skillCat4Rating
			. '\',\'' . $date . '\')' );


		$to      = $this->email;
		$subject = 'Submitted: Thanks for filling the form';
		$message = "Hello $this->firstName, your information is saved successfully, Thanks //:" . Config::get( 'app.APP_URL' ) . Config::get( 'app.APP_EXTRA_URL' );
		$headers = 'From: gopalindians@gmail.com' . "\r\n" .
		           'Reply-To: gopalindians@gmail.com' . "\r\n" .
		           'Content-type: text/html; charset=utf-8' . "\r\n" .
		           'MIME-Version: 1.0' . "\r\n" .
		           'X-Mailer: PHP/' . PHP_VERSION;

		mail( $to, $this->email, $subject, $message, $headers );

		$response['message'] = 'Saved successfully!';
		$response['type']    = 'success';
		return $this->responseJson( $response );


	}

	/**
	 * To log error response
	 *
	 * @param string $message
	 * @param string $type
	 *
	 * @return mixed
	 */
	private function logError( $message = '', $type = '' ) {
		$response['message'] = $message;
		$response['type']    = $type ? $type : 'error';

		return $response;
	}


	/**
	 * Properly  formatted  response in json
	 *
	 * @param string $response
	 *
	 * @return string
	 */
	private function responseJson( $response = '' ) {
		header( 'Content-Type: application/json' );

		return json_encode( $response );
	}
}