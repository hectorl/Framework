<?php

/**
 * @author		http://snipplr.com/view.php?codeview&id=35627
 */
class Browser extends APPLICATION {

	private $props = array("Version" => "0.0.0",
                             "Name" => "unknown",
                             "Agent" => "unknown",
                             'OS' => null,
                             'forbid' => array());

	/**
	 * Get browser data from its headers
	 *
	 * @param  array $forbid Array contining the forbidden browsers:
	 *                         - array([browser1] => array([version1], [version2]),
	 *                                 [browser2] => array([version1], [version2]), ...)
	 */
	public function __construct($forbid){

		$browsers = array("firefox", "msie", "opera", "chrome", "safari",
                            "mozilla", "seamonkey",    "konqueror", "netscape",
                            "gecko", "navigator", "mosaic", "lynx", "amaya",
                            "omniweb", "avant", "camino", "flock", "aol");

		$this->forbid = $forbid;

		$this->Agent = strtolower($_SERVER['HTTP_USER_AGENT']);

		foreach($browsers as $browser){

			if(preg_match("#($browser)[/ ]?([0-9.]*)#", $this->Agent, $match)){

				$this->Name = $match[1];
				$this->Version = $match[2];
				$this->OS = PHP_OS;
				break ;

			}//end if

		}//end foreach

	}//end __construct


	/**
	 * Evaluates if the browser is supported
	 * @return boolean
	 */
	public function supported () {

		foreach ($this->forbid as $browser => $version) {

			if ($this->Agent == $browser
				&& in_array($this->Version, $version))
			{

				return false;

			}//end if

		}//end foreach

		return true;

	}//end supported


	/**
	 * [__get description]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	public function __get($name){

		if(!array_key_exists($name, $this->props)){

			die("No such property or function $name");

		}//end if

		return $this->props[$name];

	}//end __get


	/**
	 * [__set description]
	 * @param [type] $name [description]
	 * @param [type] $val  [description]
	 */
	public function __set($name, $val){

		if(!array_key_exists($name, $this->props)){

            SimpleError("No such property or function.", "Failed to set $name", $this->props);
            die();

		}//end if

		$this->props[$name] = $val;

	}//end __set

}//end Browser