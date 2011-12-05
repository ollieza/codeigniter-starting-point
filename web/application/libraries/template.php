<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * Template class
 * Loads view files with a template
 * Manage page titles, css body id, class and js files, meta tags
 *
 * @package   template
 * @version   1.0
 * @author    Ollie Rattue, Too many tabs <orattue[at]toomanytabs.com>
 * @copyright Copyright (c) 2010, Ollie Rattue
 * @license   http://www.opensource.org/licenses/mit-license.php
 * @link      http://github.com/ollierattue/codeigniter-template
 */

class Template {

	var $CI;
	var $config;
	var $meta_keywords;
	var $meta_description;
	var $body_id = NULL;
	var $body_class = NULL;
	var $page_title;
	var $template_name = 'default';
	
	function Template()
	{
		// Load CI instance so we can get config values etc
		$this->CI =& get_instance();

		// Load config		
		$this->CI->load->config('templatelib_config', TRUE);
		$this->config = $this->CI->config->item('templatelib_config');
		
		$this->page_title = $this->config['template_page_title'];
		$this->meta_keywords = $this->config['template_meta_keywords'];
		$this->meta_description = $this->config['template_meta_description'];
	}

	// --------------------------------------------------------------------
	
	function meta_description($description = NULL)
	{
		$this->meta_description = $description;
	}
	
	// --------------------------------------------------------------------

	function meta_keywords($keywords = NULL)
	{
		$this->meta_keywords = $keywords;
	}
	
	// --------------------------------------------------------------------
		
	function page_title($title = NULL)
	{
		$this->page_title = $title;
	}

	// --------------------------------------------------------------------
	
	function body_id($body_id = NULL)
	{
		$this->body_id = $title;
	}

	// --------------------------------------------------------------------
	
	function body_class($body_class = NULL)
	{
		$this->body_class = $body_class;
	}

	// --------------------------------------------------------------------	
	
	function template_name($template_name = NULL)
	{
		$this->template_name = $template_name;
	}

	// --------------------------------------------------------------------
			
	function build_page($path = NULL, $data = NULL)
	{
		$data['path'] = $path;
		$data['body_id'] = $this->body_id;
		$data['body_class'] = $this->body_class;
		$data['page_title'] = $this->page_title;
		$data['meta_keywords'] = $this->meta_keywords;
		$data['meta_description'] = $this->meta_description;

		if (is_array($path))
		{
			$path = $path[0]; // arrays of view files are not supported yet
		}

		@list($controller) = explode("/", substr($path, 0));

		$this->CI->load->vars($data);

		// Auto-set admin template based on the controller
		if ($controller == 'admin')
		{
			$this->template_name = 'admin';
		}
		
		$this->CI->load->view("templates/{$this->template_name}/base");
	}
	
	// --------------------------------------------------------------------
}

/* End of file template.php */
/* Location: ./application/libraries/template.php */