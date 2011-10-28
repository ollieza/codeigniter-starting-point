<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------

// Function to redirect browser to an external URL

function external_redirect($url = NULL)
{
   	if (!headers_sent())
	{
		header('Location: '.$url);
   	}
	else
	{
		echo '<script type="text/javascript">';
    	echo 'window.location.href="'.$url.'";';
       	echo '</script>';
       	echo '<noscript>';
       	echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
       	echo '</noscript>';
   	}
}

// --------------------------------------------------------------------

function get_domain($url = NULL)
{
	if (!$url)
	{
		$url = base_url();
	}
	
    $CI =& get_instance();
    return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", $url);
} 

// --------------------------------------------------------------------

function admin_url()
{
	echo base_url().'admin/';
}

// --------------------------------------------------------------------

function image_url()
{
	echo base_url().'_/img/';
}

// --------------------------------------------------------------------

function upload_url()
{
	echo base_url().'uploads/';
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

/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */