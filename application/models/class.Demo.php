<?php
/**
 * Gallery model
 */

namespace models;

use Db;
use PDO;
use Dbug;
use Helper;

class Demo
{

	public function __construct () {

		Db::register('fornor')
				->db_host(DB_HOST)
				->db_name(DB_NAME)
				->db_user(DB_USER)
				->db_pass(DB_PASS);

	}//end __construct

}//end Demo