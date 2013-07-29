<?php
/**
 * returns a uid value
 * @param string $prefix string to prefix to the returned uid
 * @return string
 */
function get_uid($prefix="") {
    return $prefix.md5(uniqid(mt_rand(), true));
}//end get_uid