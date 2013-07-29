<?php

class Db
{

	private static
		$_current_connection,
		$_dbh = array(),
		$_instance,
		$_connections = array();


	public static function init ($conn) {

		if (!self::$_dbh[$conn] instanceof PDO) {

			$db_host = self::$_connections[$conn]['db_host'];
			$db_name = self::$_connections[$conn]['db_name'];
			$db_user = self::$_connections[$conn]['db_user'];
			$db_pass = self::$_connections[$conn]['db_pass'];

			try {

				self::$_dbh[$conn] = new PDO(
					"mysql:host={$db_host};dbname={$db_name};charset=utf8",
					$db_user,
					$db_pass,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
				);

			} catch (PDOException $e) {

				die($e->getError());

			}//end catch

			self::$_dbh[$conn]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}//end if

		return self::$_dbh[$conn];

	}//end init


	public function register ($conn) {

		if (!self::$_instance)
            self::$_instance = new Db();

        self::$_current_connection = $conn;

		self::$_connections[self::$_current_connection] = array();;

		return self::$_instance;

	}//end register


	public function db_host ($host) {

		self::$_connections[self::$_current_connection]['db_host'] = $host;

		return self::$_instance;

	}//end db_host

	public function db_name ($db_name) {

		self::$_connections[self::$_current_connection]['db_name'] = $db_name;

		return self::$_instance;

	}//end db_name


	public function db_user ($db_user) {

		self::$_connections[self::$_current_connection]['db_user'] = $db_user;

		return self::$_instance;

	}//end db_user


	public function db_pass ($db_pass) {

		self::$_connections[self::$_current_connection]['db_pass'] = $db_pass;

		return self::$_instance;

	}//end db_pass


	public function get_register ($conn) {

		echo '<pre>';
		var_dump(self::$_connections[$conn]);
		echo '</pre>';

	}//end get_register

}//end Db