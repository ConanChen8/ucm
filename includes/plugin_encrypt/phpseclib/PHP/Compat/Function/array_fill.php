<?php 
/** 
  * Copyright: dtbaker 2012
  * Licence: Please check CodeCanyon.net for licence details. 
  * More licence clarification available here:  http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
  * Deploy: 10509 6566fbbc14e47c4c2873c255bd4c7a96
  * Envato: 1100806b-c9fc-484c-80fa-ee3b4b7a2080
  * Package Date: 2016-04-14 02:55:25 
  * IP Address: 1
  */
// $Id: array_fill.php,v 1.1 2007/07/02 04:19:55 terrafrost Exp $


/**
 * Replace array_fill()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright   2004-2007 Aidan Lister <aidan@php.net>, Arpad Ray <arpad@php.net>
 * @link        http://php.net/function.array_fill
 * @author      Jim Wigginton <terrafrost@php.net>
 * @version     $Revision: 1.1 $
 * @since       PHP 4.2.0
 */
function php_compat_array_fill($start_index, $num, $value)
{
    if ($num <= 0) {
        user_error('array_fill(): Number of elements must be positive', E_USER_WARNING);

        return false;
    }

    $temp = array();

    $end_index = $start_index + $num;
    for ($i = (int) $start_index; $i < $end_index; $i++) {
        $temp[$i] = $value;
    }

    return $temp;
}

// Define
if (!function_exists('array_fill')) {
    function array_fill($start_index, $num, $value)
    {
        return php_compat_array_fill($start_index, $num, $value);
    }
}