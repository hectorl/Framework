<?php
/**
 * Lang management
 *
 */
class Lang {

	/**
	 * Directory of the langs files
	 * @var string
	 */
	const
		DIR_LANGS = 'langs/';

	private
		/**
		 * Default loaded langugage
		 * @var string
		 */
		$_default_lang = null;

	public
		/**
		 * Language used by the user
		 * @var string
		 */
		$lang = null,
		/**
		 * Strings traductions returned by require lang file
		 * @var array
		 */
		$t    = array();


	/**
	* Class constructor. Gets the language. Check if exists. Creates cookie.
	* In case of desire language doesn't exists, it uses the default one.
	*
	* @param  string $default_language Default loaded langugage
	* @param string $lang Desire language
	*/
	public function __construct ($default_language, $lang = null) {

		$this->_default_lang = $default_language;

		$lang = ($lang != null) ? strtoupper($lang) : (isset($_COOKIE['lang']) ? $_COOKIE['lang'] : null);

		if ($lang != null) {

			if (file_exists(self::DIR_LANGS . $lang . '.php')) {

				$this->lang = $lang;

			} else {

				$this->_get_browser_lang();

			}//end else

		} else {

			$this->_get_browser_lang();

		}//end else

		if (isset($_COOKIE['lang'])) {

			if ($_COOKIE['lang'] != $this->lang) {

				setcookie('lang', $this->lang, time() + 3600 * 24 * 365, '/');

			}//end if

		} else {

			setcookie('lang', $this->lang, time() + 3600 * 24 * 365, '/');

		}//end else

	}//end __construct


	/**
	* Gets the browser language and check if is in languages acepted
	*/
	private function _get_browser_lang () {

		$browser_lang = strtoupper(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));

		$this->lang = $browser_lang;
/*
		$this->lang = in_array($browser_lang, $this->_accept_langs)
						? $browser_lang
						: $this->_default_lang;
*/
	}//end _get_browser_lang


	/**
	* Require the language file and save it contents insisde the "$t" attributte
	*/
	public function get_lang_file () {

		if ($this->lang != null) {

			$lang = file_exists(self::DIR_LANGS . $this->lang . '.php') ? $this->lang : $this->_default_lang;

			require self::DIR_LANGS . $lang . '.php';

			$this->t = $t;

		}//end if

	}//end get_lang_file

}//end Lang