<?php defined( 'APP_VERSION' ) or die();

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
 * Class DB
 */
class DB {
	/**
	 * @var \PDO
	 */
	private static $pdo;

	/**
	 * DB constructor to connect to database
	 *
	 * @throws \PDOException
	 */
	public function __construct() {
		try {
			self::$pdo = new PDO( 'mysql:host=' . Config::get( 'db.DB_HOST' ) . ';dbname=' . Config::get( 'db.DB_NAME' ) . ';', Config::get( 'db.DB_USERNAME' ), Config::get( 'db.DB_PASSWORD' ) );
		} catch ( PDOException $PDOException ) {
			throw  $PDOException;
		}
	}

	/**
	 * The magic behind this DB Facade is __callStatic() method that will help you run your SQL query
	 *
	 * @param $method
	 * @param $params
	 *
	 * @return array
	 * @throws \PDOException
	 */
	public static function __callStatic( $method, $params ) {
		try {
			return self::$pdo->query( $params[0], PDO::FETCH_ASSOC )->fetchAll();
		} catch ( PDOException $PDOException ) {
			throw $PDOException;
		}
	}
}

# initialize the DB class
# this will help connect to mysql
# to use the DB Facade use DB::query('YOUR QUERY') syntax
new DB();