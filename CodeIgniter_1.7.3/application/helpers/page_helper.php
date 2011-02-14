<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------

# Returns a language file using sprintf to substitute variable where necessary

function language($language_key = NULL, $variable = NULL)
{
	$CI =& get_instance();
	$CI->lang->load('flash_messages','english');

	if (!empty($variable))
	{
		return sprintf($CI->lang->line($language_key),$variable);
	}

	return $CI->lang->line($language_key);
}

// --------------------------------------------------------------------

// The perfect PHP clean url generator - http://cubiq.org/the-perfect-php-clean-url-generator/12
function create_slug($str, $replace = array(), $delimiter = '-', $currentMaximumURLLength = 160)
{
	setlocale(LC_ALL, 'en_US.UTF8');

	if( !empty($replace) )
	{
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	if (strlen($clean) > $currentMaximumURLLength)
	{
		$clean = substr($clean, 0, $currentMaximumURLLength);
    }

	return $clean;
}

// --------------------------------------------------------------------

// A function to check whether string is an email address

function is_valid_email($email)
{
  	$result = TRUE;

  	if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email))
	{
    	$result = FALSE;
  	}

	return $result;
}

// --------------------------------------------------------------------

// --------------------------------------------------------------------

// Original PHP code by Chirp Internet: www.chirp.com.au 
// Please acknowledge use of this code by including this header. 

function truncate($string, $limit = 500, $break=" ", $pad="...", $return_array = FALSE) 
{ 
	// return with no change if string is shorter than $limit  
	if (strlen($string) <= $limit)
	{
		if ($return_array)
		{
			return FALSE;
		}
		else
		{
			return $string;
		}
	} 
	
	$string = substr($string, 0, $limit); 

	if (false !== ($breakpoint = strrpos($string, $break))) 
	{
		$string = substr($string, 0, $breakpoint); 
	} 
	
	if ($return_array)
	{
		return array(
		        'string' 		=> "{$string}{$pad}", 
		        'breakpoint' 	=> $breakpoint
		        );
	}
	
	return "{$string}{$pad}";
}

// --------------------------------------------------------------------

// Echo's text stored in the database which was entered via textarea

function decode_text($text = NULL)
{
	return html_entity_decode($text, ENT_QUOTES, 'UTF-8');
}

// --------------------------------------------------------------------

function print_textarea($text = NULL)
{
	echo nl2br($text);
}

// --------------------------------------------------------------------

function display_flashdata()
{
	$CI =& get_instance();
	
	// displays message set by previous page
	if ($CI->session->flashdata('flash') != '')
	{
		echo $CI->session->flashdata('flash');
	} 	
}

// --------------------------------------------------------------------

function generate_body_tag($id = NULL, $class = NULL)
{
	$body_tag = '<body';

	if ($id)
	{
		$body_tag = '<body id="' . $id . '"';
	}

	if ($class)
	{
		$body_tag .= ' class="' . $class . '"';
	}

	return $body_tag . '>';	
}

// --------------------------------------------------------------------

/* End of file page_helper.php */
/* Location: ./application/helpers/page_helper.php */