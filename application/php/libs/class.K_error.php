<?php

class K_error extends Exception
{
    /**
     * Redeende the exception so message isn't optional
     */
    public function __construct($message, $code = 0, Exception $previous = null) {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);

    }//end __construct


    /**
     * Custom string representation of object
     */
    public function __toString() {

        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";

    }//end __toString


    public function get_decorate_message(){

        $msg = '<div style="background:url(application/views/img/errors/k_error.png) no-repeat  25px center #FFBABA; border:2px solid; color:#D8000C; margin:10px 0; padding:15px 10px 15px 80px;">

                <p>' . $this->get_style_code($this->code) . ': ' . $this->message . '</p>

                </div>';

        echo $msg;

    }//end get_decorate_message


    /**
     * Saca el string a partir del código del error
     *
     * @param int $code Código de error
     * @return string Cadena de texto a partir del código
     */
    public function get_style_code($code){

        switch ($code) {

            case 0: return 'error';
            case 1: return 'warning';
            default: return '';

        }//end switch

    }//end get_style_code


    /**
     *
     */
    public function customFunction() {

        echo "A custom function for this type of exception\n";

    }//customFunction

}//end K_error