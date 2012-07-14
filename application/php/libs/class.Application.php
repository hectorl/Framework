<?php
/**
 * Core app class
 *
 */

class Application {

	/**
	 * Prefix of varibles in case of collision on extract function
	 * @var string
	 */
	const VAR_PREFIX  = 'get';

	const DEFAULT_VIEW = 'Home';
	/**
	 * Parts from URL used in the core app
	 * @var array
	 */
	//public $uri = array('controller' => 'home', 'method' => '', 'var' => array());
	/**
	 * Directory of controllers
	 * @var string
	 */
	static protected $controllers = null;
	/**
	 * Directory of models
	 * @var string
	 */
    static protected $models;
	/**
	 * Directory of views
	 * @var string
	 */
    static protected $views;
	/**
	 * Configuration data
	 * @var array
	 */
    static protected $config;
    /**
     * Instance of Application
     * @var  APPLICATION
     */
	static protected $instance;
	/**
	 * Page prefix:
	 *  - site  -> front end [default]
	 */
	static protected $prefix = 'site';
	/**
	 * Lang used by the user: code and string
	 *
	 * @var Lang
	 */
	static protected $lang;

	private $smarty;


	/**
	 * Fill the config attribute and check the URL for loading controllers
	 *
	 * @param array $config Configuration from .ini files
	 */
	private function __construct ($config, $smarty) {

		$this->smarty = $smarty;

		$this->_set_routes($config);

	}//end __construct


	/**
	 *
	 */
	public function set_lang ($uri) {

		if ($uri['controller'] == 'lang') {

			self::$lang = new Lang($uri['method']);
			header('Location:' . $config['SITE']['url_site']);
			exit();

		} else {

			self::$lang = new Lang();
			self::$lang->get_lang_file();

		}//end else

	}//end set_lang



	/**
	 *
	 **/
	public function explode_url ($url) {

		$uri = array('controller' => self::DEFAULT_VIEW, 'method' => '', 'var' => '');

		$url = str_replace(self::$config['SITE']['url_site'] .
						   self::$config['SITE']['path'], '', strtolower($url));

		$array_tmp_uri = preg_split('[\\/]', $url, -1, PREG_SPLIT_NO_EMPTY);

		if (sizeof($array_tmp_uri) > 0) {

			$uri['controller'] = $array_tmp_uri[0];

			if (sizeof($array_tmp_uri) == 3) {

				//Check URL GET params. Usefull for AJAX calls
				if (strpos($array_tmp_uri[2], '?') !== false) {

					foreach ($_REQUEST as $key => $val) {

						$uri['var'][strtolower($key)] = $val;

					}//end foreach

					$uri['method'] = (isset($array_tmp_uri[1])) ? strtolower($array_tmp_uri[1]) : '';

				} else {

					$uri['var'][$array_tmp_uri[1]] = $array_tmp_uri[2];

				}//end else

			} else {

				$uri['method'] = (isset($array_tmp_uri[1])) ? $array_tmp_uri[1] : '';

				if (sizeof($array_tmp_uri) > 3) {

					for ($k = 2, $len = sizeof($array_tmp_uri) - 2; $k <= $len; $k += 2) {

						$uri['var'][$array_tmp_uri[$k]] = $array_tmp_uri[$k + 1];

					}//end for

				}//end if

			}//end else

		}//end if

		return $uri;

	}//end explode_url



	/**
	 * Init class for instantiate Application object
	 *
	 * @param array $config Configuration from .ini files
	 */
	public static function init($config, $smarty) {

    	if (!isset(self::$instance)) {

            $obj = __CLASS__;
        	self::$instance = new $obj($config, $smarty);

        }//end if

    	return self::$instance;

	}//end init


    /**
     * Prevent cloning of the object: issues an E_USER_ERROR if this is attempted
     */
    public function __clone() {

        trigger_error( 'Cloning the registry is not permitted', E_USER_ERROR );

    }//end __clone


	/**
	 * Load the controller.
	 * Check if the project is in maintenance status.
	 * Check if the browser is Internet Explorer 6 or 7
	 * Then, load the controller that we want.
	 *
	 * @param array $uri Array of the exploding URL
	 */
	function load_controller($uri) {

		//self::$lang = new Lang();
		//self::$lang->get_lang_file();

		$class = ucfirst($uri['controller']);

		$browser = new Browser(array('msie' => array(6, 7)));

		if (self::$config['maintenance']) {

			$class = 'Maintenace';

		} elseif (!$browser->supported()) {

			$data = array(
						'browser' => $browser->Version,
						'os'      => $browser->OS
					);

			$class = 'Browser_not_compatible';
			$uri['var'] = $data;

			//$this->load_view('browser_not_compatible', $data);

		} else {

			if (!file_exists(self::$controllers . 'class.' . $class . '.php')) {

				$class = 'Error';
				$uri['var'] = array('error_type' => 404);

			}//end if

		}//end elseNo

		$controller = new $class($this->smarty);

		if (method_exists($controller, $uri['method'])) {

			$controller->{$uri['method']}($uri['var']);

		} else {

			$controller->index($uri['var']);

		}//end else

	}//end load_controller


	/**
	 * Gets vars from array, the lang information and loads the view
	 *
	 * @param string $view Name of view
	 * @param array $vars All variables used in the view
	 * @param array $email Sets if the view is an email or not
	 */
	function load_view($view, $vars = null, $email = false) {

		$cfg = self::$config['SITE'];

		if (is_array($vars) && sizeof($vars) > 0) {

			extract($vars, EXTR_PREFIX_SAME, self::VAR_PREFIX);

		}//end if

		$t      = self::$lang->t;
		$t_code = self::$lang->lang;

		if (!$email) {

			require_once self::$views . 'pages/' . self::$prefix . '.' . $view . '.phtml';

		} else {

			require_once self::$views . 'emails/' . 'email.' . $view . '.phtml';

		}//end else

	}//end load_view


	/**
	 * Loads the model
	 *
	 * @param string $model Name of model
	 */
	function load_model($model) {

		$this->$model = new $model;

	}//end load_model


	/**
	 * Set all project routes
	 *
	 * @param array $config Configuration from .ini files
	 */
	public function _set_routes ($config) {

		self::$config      = $config;
		self::$controllers = self::$config['SITE']['dir_site'] . 'application/controllers/';
		self::$models      = self::$config['SITE']['dir_site'] . 'application/models/';
		self::$views       = self::$config['SITE']['dir_site'] . 'application/views/';

		self::$config['SITE']['url_img'] = self::$config['SITE']['url_site'] . 'application/views/img/';
		self::$config['SITE']['url_css'] = self::$config['SITE']['url_site'] . 'application/views/css/';
		self::$config['SITE']['url_js']  = self::$config['SITE']['url_site'] . 'application/views/js/';
		self::$config['SITE']['url_upl'] = self::$config['SITE']['url_site'] . 'uploads/';

		$this->smarty->setTemplateDir(self::$config['SITE']['dir_site'] . 'application/views/pages/templates/');
		$this->smarty->setCompileDir(self::$config['SITE']['dir_site'] . 'application/views/pages/templates_c/');
		$this->smarty->setConfigDir(self::$config['SITE']['dir_site'] . 'application/views/pages/configs/');
		$this->smarty->setCacheDir(self::$config['SITE']['dir_site'] . 'application/views/pages/cache/');

	}//end _set_routes

}//end Application