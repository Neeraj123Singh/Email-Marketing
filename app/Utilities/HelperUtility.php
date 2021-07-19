<?php

/**
 * HelperUtility.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Utilities;

class HelperUtility
{
    ///////////////////////////////////////////////////////////////////////////
    //  Authentication Utility
    ///////////////////////////////////////////////////////////////////////////
    // 
    //  The utility is responsible for handling all the authentication related 
    //  queries.
    // 
    ///////////////////////////////////////////////////////////////////////////

    /**
     * KeyVal verifies the key in an array, if not found then sets a default value
     * 
     * @param array $array
     * @param string $key
     * @param mixed $value
     * @return mixed 
     */
    public static function keyVal(array $array, string $key, $value = null)
    {
        return key_exists($key, $array) ? $array[$key] : $value;
    }

    /**
     * Split Name - splits the name string into middle first and last name 
     * 
     * @param string $name
     * @return array
     */
    public static function split_name($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );

        return array($first_name, $last_name);
    }

    /**
     * Generate a random string 
     * 
     * @param  int|null $len
     * @return string 
     */
    public static function srand($len = 16)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle($permitted_chars), 0, $len);
    }
}
