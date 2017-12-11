<?php
# use this constant to restrict the access to direct script
define( 'APP_VERSION', '0.1-beta' );

$config = [
	'db'  => [
		'DB_HOST'     => 'localhost',
		'DB_NAME'     => 'root',
		'DB_USERNAME' => 'root',
		'DB_PASSWORD' => '',
	],
	'app' => [
		'APP_URL'       => 'http://localhost/', # example http://myurl.com/
		'APP_EXTRA_URL' => 'i/gosh/',           # example dummy/

		'BASE_DIR' => dirname( __DIR__ ),
		'DEBUG'    => false,

		'ADMIN_USER_NAME' => 'cueblocks',
		'ADMIN_PASSWORD'  => 'cueblocks',

	],
	'map' => [
		'API_KEY' => ''
	]
];


###############################
#                             #
#                             #
#                             #
# Don't edit below this Line  #
#                             #
#                             #
#                             #
###############################


/**
 * Class Config
 */
class Config {
	/**
	 * @var array stores all the config array
	 */
	public $config = [];

	/**
	 * Config constructor.
	 *
	 * @param $config
	 *
	 */
	public function __construct( $config ) {
		$this->config = $config;
		foreach ( $this->config as $key => $item ) {
			foreach ( $item as $k => $i ) {
				$_ENV[ $key . '.' . $k ] = $i;
			}
		}
	}

	/**
	 *
	 * Get environment variable  statically
	 *
	 * @param $method
	 * @param $argument
	 *
	 * @return mixed
	 */
	public static function __callStatic( $method, $argument ) {
		return $_ENV[ $argument[0] ?? '' ];
	}

	/**
	 * Get env variable
	 *
	 * @param $method
	 * @param $argument
	 *
	 * @return mixed
	 */
	public function __call( $method, $argument ) {
		return $_ENV[ $argument[0] ?? '' ];
	}


	/**
	 * get the current route being used
	 *
	 * @return mixed|string
	 */
	public static function getCurrentRoute() {
		$path                      = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
		$_ENV['app.APP_EXTRA_URL'] = trim( $_ENV['app.APP_EXTRA_URL'], '/' );
		$vanillaPath               = trim( $path, '/' );
		$vanillaPath               = str_replace( [ $_ENV['app.APP_EXTRA_URL'], '//' ], '', $vanillaPath );
		$vanillaPath               = trim( $vanillaPath, '/' );

		return $vanillaPath;
	}


	/**
	 * @param string $tagName
	 *
	 * @return string
	 */
	public static function getMetaTag( $tagName = '' ) {

		$tags = get_meta_tags( '//' . $_SERVER['HTTP_HOST'] . Config::get( 'APP_EXTRA_URL' ) );

		if ( $tagName !== '' ) {
			return $tags[ $tagName ];
		}

		return $tagName;

	}
}

new Config( $config );