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

	const DEFAULT_CONTROLLER = 'Home';

	const TRANSLATIONS_TYPE = 'file';		//file|db
	const TPL_PREFIX = '';				//phtml|php
	const TPL_SUFIX = 'phtml';				//phtml|php

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
	private function __construct ($config) {

		self::$controllers = SITE_DIR . 'application/controllers/';
		self::$models      = SITE_DIR . 'application/models/';
		self::$views       = SITE_DIR . 'application/views/';

		if (PROJECT_SMARTY) {

			$this->smarty = new Smarty();
			$this->smarty->assign('google_analytics', SITE_GOOGLE_ANALYTICS);

		}//end if

		$this->_set_routes();

	}//end __construct


	/**
	 * Init class for instantiate Application object
	 *
	 * @param array $config Configuration from .ini files
	 */
	public static function init($config) {

    	if (!isset(self::$instance)) {

            $obj = __CLASS__;
        	self::$instance = new $obj($config);

        }//end if

    	return self::$instance;

	}//end init



	/**
	 * Custom autoloader.
	 *
	 * Check if the class has namespace and loads it
	 *
	 * @param	string	$class		Name of the class
	 */
	static public function load_libs ($class) {

		try {

			if (strpos($class, '\\')) {

				$class_pieces = explode('\\', $class);
				$class_pieces = array_filter($class_pieces, 'strlen');
				$class_pieces = array_values($class_pieces);

				$dir = SITE_DIR . 'application/' . $class_pieces[0] . '/';
				$class = $class_pieces[1];

			} else {

				$dir = '';
				$class = $class;

			}//end if

			$found = stream_resolve_include_path($dir . 'class.' . $class . '.php');

			if ($found !== false) {
				require_once $dir . 'class.' . $class . '.php';
			} else {
				throw new K_error('Class <b>class.' . $class . '.php</b> does not exist.');
			}//end else

		} catch (K_error $e) {

			echo $e->get_decorate_message();
			die();

		}//end catch

	}//end load_libs


	/**
	 *
	 */
	public function set_lang ($uri) {

		if ($uri['controller'] == 'lang') {

			$language_selected = $uri['method'];

			self::$lang = new Lang(SITE_DEFAULT_LANG, $language_selected);
			header('Location:' . SITE_URL);
			exit();

		} else {

			self::$lang = new Lang(SITE_DEFAULT_LANG);
			self::$lang->get_translations(self::TRANSLATIONS_TYPE);

			if (PROJECT_SMARTY) {

				$this->smarty->assign('lang_code', self::$lang->lang);
				$this->smarty->assign('t', self::$lang->t);

			} else {
				define('LANG_CODE', self::$lang->lang);
			}//end if

		}//end else

	}//end set_lang



	/**
	 *
	 */
	public function explode_url ($url) {

		$uri = array('controller' => self::DEFAULT_CONTROLLER, 'method' => '', 'var' => '');

		$url = str_replace(SITE_PATH, '', strtolower($url));

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

		$class = ucfirst($uri['controller']);

		$browser = new Browser(array('msie' => array(6, 7)));

		if (PROJECT_MAINTENANCE) {
			$class = 'Maintenance';
		} elseif (!$browser->supported()) {

			$data = array(
						'browser' => $browser->Version,
						'os'      => $browser->OS
					);

			$class = 'Browser_not_compatible';
			$uri['var'] = $data;

		} else {

			if (!file_exists(self::$controllers . 'class.' . $class . '.php')) {

				$class = 'Error';
				$uri['var'] = array('error_type' => 404);

			}//end if

		}//end elseNo

		$namespaced_controller = "\controllers\\" . $class;

		$controller = new $namespaced_controller($this->smarty);

		if (method_exists($controller, $uri['method'])) {
			$controller->{$uri['method']}($uri['var']);
		} else {
			$controller->index($uri['var']);
		}//end else

	}//end load_controller


	/**
	 * Loads the model
	 *
	 * @param string $model Name of model
	 */
	function load_model($model) {

		$namespaced_model = "\models\\" . $model;
		$this->$model = new $namespaced_model;

	}//end load_model


	/**
	 * Gets vars from array, the lang information and loads the view
	 *
	 * @param string $view Name of view
	 * @param array $vars All variables used in the view
	 */
	function load_view ($view, $vars = null) {

		if (is_array($vars) && sizeof($vars) > 0) {
			extract($vars, EXTR_PREFIX_SAME, self::VAR_PREFIX);
		}//end if

		$t = self::$lang->t;

		require_once TPL . self::TPL_PREFIX . $view . '.' . self::TPL_SUFIX;

	}//end load_view


	/**
	 * Set all project routes
	 *
	 * @param array $config Configuration from .ini files
	 */
	public function _set_routes () {

		if (PROJECT_SMARTY) {

			$this->smarty->assign('URL', SITE_URL);
			$this->smarty->assign('IMG', SITE_URL . 'application/views/img/');
			$this->smarty->assign('CSS', SITE_URL . 'application/views/css/');
			$this->smarty->assign('JS',  SITE_URL . 'application/views/js/');
			$this->smarty->assign('UPL', SITE_URL . 'uploads/');

			$this->smarty->setTemplateDir(SITE_DIR . 'application/views/pages/templates/');
			$this->smarty->setCompileDir(SITE_DIR . 'application/views/pages/templates_c/');
			$this->smarty->setConfigDir(SITE_DIR . 'application/views/pages/configs/');
			$this->smarty->setCacheDir(SITE_DIR . 'application/views/pages/cache/');

		} else {

			define('IMG',   SITE_URL . 'application/views/img/');
			define('CSS',   SITE_URL . 'application/views/css/');
			define('JS',    SITE_URL . 'application/views/js/');
			define('UPL',   SITE_URL . 'uploads/');
			define('TPL',   SITE_DIR . 'application/views/pages/templates/');
			define('TPL_C', SITE_DIR . 'application/views/pages/cache/');

		}//end else

	}//end _set_smarty_routes




}//end Application