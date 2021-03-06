<?php
/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 16:32
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sanitize_int'))
{
    function sanitize_int($var = '')
    {
        return filter_var($var, FILTER_VALIDATE_INT);
    }
}

if (!function_exists('trans'))
{
    function trans($phrase, ...$placeholders)
    {
        $phrase = lang($phrase);
        if ($placeholders)
        {
            $phrase = sprintf($phrase, ...$placeholders);
        }
        return htmlspecialchars($phrase);
    }
}
