<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------

/**
* function build_page()
*
* a simple template system
* @access private
* @param $page - string
* @param $title - string
* @param $data - string
* @return string
*/

function build_page($path, $data = NULL, $page_title = NULL, $body_id = NULL, $body_class = NULL, $iframe = FALSE)
{
	$CI =& get_instance();
	
	$data['path'] = $path;
	$data['body_id'] = $body_id;
	$data['body_class'] = $body_class;
	$data['page_title'] = $page_title;
	$data['meta_keywords'] = (isset($data['meta_keywords']) && $data['meta_keywords']) ? $data['meta_keywords'] : META_KEYWORDS;
	$data['meta_description'] = (isset($data['meta_description']) && $data['meta_description']) ? $data['meta_description'] : META_DESCRIPTION;

	if (is_array($path))
	{
		$path = $path[0];
	}

	@list($controller, $function, $page_view) = explode("/", substr($path, 0));
	
	$CI->load->vars($data);

	if ($iframe)
	{
		$CI->load->view('templates/iframe/base');
	}
	else
	{
		switch($controller)
		{
			case 'admin':
				$CI->load->view('templates/admin/base');
			break;

			default:
				$CI->load->view('templates/frontend/base');
			break;
		}		
	}
}

// --------------------------------------------------------------------

/* End of file template.php */
/* Location: ./application/helpers/template.php */