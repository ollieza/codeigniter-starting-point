<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Outputs an array or variable
*
* @param    $var array, string, integer
* @return    string
*/

function debug_var($var = '')
{
    echo _before();

    if (is_array($var))
    {
        print_r($var);
    }
	else
    {
        echo $var;
    }
    
	echo _after();
}
    
// --------------------------------------------------------------------

/**
* Outputs the last query
*
* @return    string
*/

function debug_last_query()
{
    $CI =& get_instance();
    echo _before();
    echo $CI->db->last_query();
    echo _after();
}
    
// --------------------------------------------------------------------

/**
* Outputs the query result
*
* @param    $query object
* @return    string
*/

function debug_query_result($query = '')
{
    echo _before();
    print_r($query->result_array());
    echo _after();
}
    
// --------------------------------------------------------------------

/**
* Outputs all session data
*
* @return    string
*/

function debug_session()
{
    $CI =& get_instance();
    echo _before();
    print_r($CI->session->all_userdata());
    echo _after();
}

// --------------------------------------------------------------------

/**
* Logs a message or var
*
* @param    $message array, string, integer
* @return    string
*/

function debug_log($message = '')
{
	is_array($message) ? log_message('debug', print_r($message)) : log_message('debug', $message);
}

// --------------------------------------------------------------------

/**
* _before
*
* @return    string
*/

function _before()
{
	$before = '<div style="padding:10px 20px 10px 20px; background-color:#fbe6f2; border:1px solid #d893a1; color: #000; font-size: 12px;>'."\n";
	$before .= '<h5 style="font-family:verdana,sans-serif; font-weight:bold; font-size:18px;">Debug Helper Output</h5>'."\n";
	$before .= '<pre>'."\n";
	return $before;
}
    
// --------------------------------------------------------------------
/**
* _after
*
* @return    string
*/

function _after()
{
	$after = '</pre>'."\n";
	$after .= '</div>'."\n";
	return $after;
}

// --------------------------------------------------------------------

/* End of file debug_helper.php */
/* Location: ./application/helpers/debug_helper.php */