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
	 * @var string
	 */
	private $firstName;

	/**
	 * @var string
	 */
	private $lastName;

	/**
	 * @var string
	 */
	private $streetName;

	/**
	 * @var string
	 */
	private $cityName;

	/**
	 * @var string
	 */
	private $zipCode;

	/**
	 * @var string
	 */
	private $state;

	/**
	 * @var string
	 */
	private $phone;

	/**
	 * @var string
	 */
	private $email;


	/**
	 * @var string
	 */
	private $skillCat1;

	/**
	 * @var string
	 */
	private $skillCat2;

	/**
	 * @var string
	 */
	private $skillCat3;

	/**
	 * @var string
	 */
	private $skillCat4;

	/**
	 * @var string
	 */
	private $skillCat1Rating;

	/**
	 * @var string
	 */
	private $skillCat2Rating;

	/**
	 * @var string
	 */
	private $skillCat3Rating;

	/**
	 * @var int
	 */
	private $skillCat4Rating;

	/**
	 * @var int
	 */
	private $skillCat1Eval;
	/**
	 * @var int
	 */
	private $skillCat2Eval;
	/**
	 * @var int
	 */
	private $skillCat3Eval;
	/**
	 * @var int
	 */
	private $skillCat4Eval;



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
	 * get all users data to show them on admin dashboard
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
     * Get detail of a user based on `user id`
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


	/** Saves the form data and sends the email
	 * @return string
	 */
	public function postUserForm() {
		$this->firstName  = trim( isset( $_POST['first_name'] ) ? $_POST['first_name'] : '' );
		$this->lastName   = trim( isset( $_POST['last_name'] ) ? $_POST['last_name'] : '' );
		$this->streetName = trim( isset( $_POST['street_name'] ) ? $_POST['street_name'] : '' );
		$this->firstName  = trim( isset( $_POST['first_name'] ) ? $_POST['first_name'] : '' );
		$this->cityName   = trim( isset( $_POST['city_name'] ) ? $_POST['city_name'] : '' );
		$this->zipCode    = (int) trim( isset( $_POST['zip_code'] ) ? $_POST['zip_code'] : '' );
		$this->state      = trim( isset( $_POST['state'] ) ? $_POST['state'] : '' );
		$this->phone      = (int) trim( isset( $_POST['phone'] ) ? $_POST['phone'] : '' );
		$this->email      = trim( isset( $_POST['email'] ) ? $_POST['email'] : '' );

		$this->skillCat1       = trim( isset( $_POST['skill_1'] ) ? $_POST['skill_1'] : '' );
		$this->skillCat1Eval   = trim( isset( $_POST['skill_1_eval'] ) ? $_POST['skill_1_eval'] : '' );
		$this->skillCat1Rating = trim( isset( $_POST['skill_1_rating'] ) ? $_POST['skill_1_rating'] : '' );

		$this->skillCat2       = trim( isset( $_POST['skill_2'] ) ? $_POST['skill_2'] : '' );
		$this->skillCat2Eval   = trim( isset( $_POST['skill_2_eval'] ) ? $_POST['skill_2_eval'] : '' );
		$this->skillCat2Rating = trim( isset( $_POST['skill_2_rating'] ) ? $_POST['skill_2_rating'] : '' );

		$this->skillCat3       = trim( isset( $_POST['skill_3'] ) ? $_POST['skill_3'] : '' );
		$this->skillCat3Eval   = trim( isset( $_POST['skill_3_eval'] ) ? $_POST['skill_3_eval'] : '' );
		$this->skillCat3Rating = trim( isset( $_POST['skill_3_rating'] ) ? $_POST['skill_3_rating'] : '' );

		$this->skillCat4       = trim( isset( $_POST['skill_4'] ) ? $_POST['skill_4'] : '' );
		$this->skillCat4Eval   = trim( isset( $_POST['skill_4_eval'] ) ? $_POST['skill_4_eval'] : '' );
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

		if ( strlen( $this->streetName ) > 255 ) {
			$response = $this->logError( 'Street Name is too long, max limit is 255' );

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
		if ( ! is_int( $this->zipCode ) ) {
			$response = $this->logError( 'Zip code must be numeric' );

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
		if ( ! is_numeric( $this->phone ) ) {

			$response = $this->logError( 'Phone number must be numeric' );

			return $this->responseJson( $response );
		}


		//email
		if ( $this->email === '' ) {
			$response = $this->logError( 'Email cannot be empty' );

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


		//cat 1,2,3,4 eval
		if ( $this->skillCat1Eval == '' && $this->skillCat2Eval == '' && $this->skillCat3Eval == '' && $this->skillCat4Eval == '' ) {
			$response = $this->logError( 'Please evaluate at least one skill category' );

			return $this->responseJson( $response );
		} else {
			if ( $this->skillCat1Eval > 10 && $this->skillCat1Eval < 0 ) {
				$response = $this->logError( 'Skill category evaluation must be between 0 to 10' );

				return $this->responseJson( $response );
			} elseif ( $this->skillCat2Eval > 10 && $this->skillCat2Eval < 0 ) {
				$response = $this->logError( 'Skill category evaluation must be between 0 to 10' );

				return $this->responseJson( $response );
			} elseif ( $this->skillCat3Eval > 10 && $this->skillCat3Eval < 0 ) {
				$response = $this->logError( 'Skill category evaluation must be between 0 to 10' );

				return $this->responseJson( $response );
			} elseif ( $this->skillCat4Eval > 10 && $this->skillCat4Eval < 0 ) {
				$response = $this->logError( 'Skill category evaluation must be between 0 to 10' );

				return $this->responseJson( $response );
			}
		}


		$date = date( 'Y-m-d h:i:s' );

		$result = DB::insert(
			'INSERT INTO  users (
first_name, last_name,
 street, city, zip, state,
  phone, email,
  created_at)
VALUES (\''
			. $this->firstName . '\',\'' . $this->lastName
			. '\',\'' . $this->streetName . '\',\'' . $this->cityName . '\',\'' . $this->zipCode . '\',\'' . $this->state
			. '\',\'' . $this->phone . '\',\'' . $this->email
			. '\',\'' . $date . '\')' );


		//get user id
		$userId = DB::getLastInsertedId();


		//insert  into skill categories table
		$skill_category_insert_1    = DB::query( 'INSERT INTO skill_categories (
                                      sc_name, user_id, sc_evaluation) 
                                 VALUES (\'Scripting languages\',\'' . $userId . '\',\'' . ( $this->skillCat1Eval ? $this->skillCat1Eval : 0 ) . '\')' );
		$skill_category_insert_1_id = DB::getLastInsertedId();
		$skill_category_insert_2    = DB::query( 'INSERT INTO skill_categories (
                                      sc_name, user_id, sc_evaluation) 
                                 VALUES (\'Other languages\',\'' . $userId . '\',\'' . ( $this->skillCat2Eval ? $this->skillCat2Eval : 0 ) . '\')' );
		$skill_category_insert_2_id = DB::getLastInsertedId();
		$skill_category_insert_3    = DB::query( 'INSERT INTO skill_categories (
                                      sc_name, user_id, sc_evaluation) 
                                 VALUES (\'Databases\',\'' . $userId . '\',\'' . ( $this->skillCat3Eval ? $this->skillCat3Eval : 0 ) . '\')' );
		$skill_category_insert_3_id = DB::getLastInsertedId();
		$skill_category_insert_4    = DB::query( 'INSERT INTO skill_categories (
                                      sc_name, user_id, sc_evaluation) 
                                 VALUES (\'Personal skills\',\'' . $userId . '\',\'' . ( $this->skillCat4Eval ? $this->skillCat4Eval : 0 ) . '\')' );
		$skill_category_insert_4_id = DB::getLastInsertedId();


		//get codebook skills data
		$skill_1 = DB::select( 'SELECT * FROM codebook_for_skills WHERE id=' . $this->skillCat1 );
		$skill_2 = DB::select( 'SELECT * FROM codebook_for_skills WHERE id=' . $this->skillCat2 );
		$skill_3 = DB::select( 'SELECT * FROM codebook_for_skills WHERE id=' . $this->skillCat3 );
		$skill_4 = DB::select( 'SELECT * FROM codebook_for_skills WHERE id=' . $this->skillCat4 );


		// insert into skills table
		$skill_insert_1 = DB::query( 'INSERT INTO skills (
                                      skill_name, skill_rating, skill_category_id, user_id) 
                                 VALUES (\'' . $skill_1[0]['skill'] . '\',\'' . $this->skillCat1Rating . '\',\'' . $skill_category_insert_1_id . '\',\'' . $userId . '\')' );

		$skill_insert_2 = DB::query( 'INSERT INTO skills (
                                      skill_name, skill_rating, skill_category_id, user_id) 
                                 VALUES (\'' . $skill_2[0]['skill'] . '\',\'' . $this->skillCat2Rating . '\',\'' . $skill_category_insert_2_id . '\',\'' . $userId . '\')' );

		$skill_insert_3 = DB::query( 'INSERT INTO skills (
                                      skill_name, skill_rating, skill_category_id, user_id) 
                                 VALUES (\'' . $skill_3[0]['skill'] . '\',\'' . $this->skillCat3Rating . '\',\'' . $skill_category_insert_3_id . '\',\'' . $userId . '\')' );

		$skill_insert_4 = DB::query( 'INSERT INTO skills (
                                      skill_name, skill_rating, skill_category_id, user_id) 
                                 VALUES (\'' . $skill_4[0]['skill'] . '\',\'' . $this->skillCat4Rating . '\',\'' . $skill_category_insert_4_id . '\',\'' . $userId . '\')' );


		$to      = $this->email;
		$subject = 'Submitted: Thanks for filling the form';
		$message = "Hello $this->firstName, your information is saved successfully";
		$headers = 'From: gopalindians@gmail.com' . "\r\n" .
		           'Reply-To: gopalindians@gmail.com' . "\r\n" .
		           'Content-type: text/html; charset=utf-8' . "\r\n" .
		           'MIME-Version: 1.0' . "\r\n" .
		           'X-Mailer: PHP/' . PHP_VERSION;

		try {
			if(!@mail( $to, $subject, $message, $headers )){
                $response['message'] = 'This server is not configured to send Emails or you are providing an invalid email address. Don\'t worry your data is saved with us';
                $response['type']    = 'error';

                return $this->responseJson( $response );
            }

		} catch ( Exception $exception ) {
            $response['message'] = 'This server is not configured to send Emails or you are providing an invalid email address. Don\'t worry your data is saved with us' ;
            $response['type']    = 'error';

            return $this->responseJson( $response );

		}


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