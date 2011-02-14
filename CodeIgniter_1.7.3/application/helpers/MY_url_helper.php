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

/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */