<?php 
/**
* MartensMCV is an simple and smal framework that make use of OOP and MVC patern.
* Copyright (C) 2012 Maikel Martens
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if (!defined('__SITE_PATH')) exit('No direct script access allowed');
/**
 * MartensMVC
 *
 * An MVC framework for PHP/MYSQL
 *
 * @author		Maikel Martens
 * @copyright           Copyright (c) 20012 - 2012, Martens.me.
 * @license		http://martens.me/license.html
 * @link		http://martens.me
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Sessoin class
 *
 * Session class for storing session data.
 *
 * @package		MartensMCV
 * @subpackage          Libraries
 * @category            Libraries
 * @author		Maikel Martens
 */
// ------------------------------------------------------------------------

class Library_Session {
    /**
     * Constructer
     *
     * Create session and load session when set.
     * Create new cookie for session and saves session
     * Clean Sessions older then 1 hour 
     *
     * @access	public
     * @return	void
     */
    function __construct() {
        session_start();
    }

    /**
     * set
     *
     * set date in sessions array and save session
     *
     * @access	public
     * @param   String  key
     * @param   -       value            
     * @return	void
     */
    function set($name, $value) {
        $_SESSION[$name] = $value;
    }
    
    /**
     * get
     *
     * Get the data out of session array, when an array is stored you can give 
     * the key for that array as second parameter 
     *
     * @access	public
     * @param   String  key
     * @param   String  secondKey  
     * @return	void
     */
    function get($key) {
        if ( isset($_SESSION[$key]) )
            return $_SESSION[$key];
        return null;
    }

}
/* End of file session.php */
/* Location: ./application/libraries/session.php */
