<?php
/**
 * trims text to a space then adds ellipses if desired
 * @param string $input text to trim
 * @param int $length in characters to trim to
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string
 */
function trim_text($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {

        $input = strip_tags($input);

    }//end if

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {

        return $input;

    }//end if

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);
    $rest_text = substr($input, $last_space, strlen($input));

    //add ellipses (...)
    if ($ellipses) {

        $trimmed_text .= '&hellip;';

    }//end if

    return $trimmed_text;

}//end trim_text