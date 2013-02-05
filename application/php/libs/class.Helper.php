<?php
/**
 * Static class to use HELPERS. User: HELPER::[name_of_helper([param1, param2, ...])]
 */
class Helper extends Application {

	/**
	 * Folder to keep all the helpers
	 *
	 * @var string
	 */
	const HELPERS_FOLDER = 'helpers/';
	/**
	 * Array with all the helpers used
	 * @var array
	 */
	private static $funcs = array();


	/**
	 * Class constructor
	 */
	private function __construct () {}


	/**
	 * Dynamic call to the helper. Check if exists the hepler inside the array.
	 * If not, it check if file exists and require it and save it into $funcs.
	 * Then, it uses "call_user_func_array" to execute the hepler with its arguments
	 *
	 * @param  string $method Helper that is going to be used
	 * @param  array $arguments Arguments used by the hepler
	 */
 	public static function __callStatic ($method, $arguments) {

 		try {

 			if (!isset(self::$funcs[$method])) {

	 			if (file_exists(SITE_DIR . 'application/php/' . self::HELPERS_FOLDER . $method . '.php')) {

	 				require SITE_DIR .
	 						'application/php/' .
	 						self::HELPERS_FOLDER .
	 						$method . '.php';

	 				self::$funcs[$method] = $method;

				} else {

					throw new Exception ('El método <b>"' . $method . '"</b> no ha sido registrado.');

				}//end else

			}//end if

			return call_user_func_array(self::$funcs[$method], $arguments);

		} catch (Exception $e) {

			echo $e->getMessage();

		}//end catch

 	}//end __callStatic

}//end HELPER