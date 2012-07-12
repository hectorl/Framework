<?php
/**
 * Singleton to create an instance of PDO
 */
class Db extends APPLICATION{

	/**
	 * Instance of the DB class
	 *
	 * @var Db
	 */
	private static $_instance = null;


	/**
	 * Connects to mysql useing utf-8 and setting names
	 *
	 * @param string $host   Database host
	 * @param string $dbname Database name
	 * @param string $user   Database user
	 * @param string $pass   Database pass
	 */
	public function __construct ($host, $dbname, $user, $pass) {

		try {

			$this->dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch(PDOException $e) {

			echo $e->getMessage();

		}//end catch

	}//end __construct


	/**
	 * Check if exists a conexion
	 * If not, it initialize data conexion from DB using the .ini config or parameters
	 * and creates an instance.
	 * If conexion exists, it returns the instance
	 *
	 * @param string $host   Database host
	 * @param string $dbname Database name
	 * @param string $user   Database user
	 * @param string $pass   Database pass
	 *
	 * @return object Class instance
	 */
	public static function init ($host = false, $dbname = false, $user = false, $pass = false) {

		if (!(self::$_instance instanceof self)) {

			$host   = (!$host)   ? parent::$config['DB']['db_host'] : $host;
			$dbname = (!$dbname) ? parent::$config['DB']['db_name'] : $dbname;
			$user   = (!$user)   ? parent::$config['DB']['db_user'] : $user;
			$pass   = (!$pass)   ? parent::$config['DB']['db_pass'] : $pass;

			self::$_instance = new self ($host, $dbname, $user, $pass);

	    }//end if

		return self::$_instance;

	}//end init


	public function prepare ($sql) {

		return $this->dbh->prepare($sql);

	}



	public function __call ($name, $arguments) {

echo "Calling object method '$name' "
             . implode(', ', $arguments). "\n";

	}


    /**
     * Prevent cloning of the object: issues an E_USER_ERROR if this is attempted
     */
    public function __clone() {

        trigger_error( 'Cloning the registry is not permitted', E_USER_ERROR );

    }//end __clone

}//end DB