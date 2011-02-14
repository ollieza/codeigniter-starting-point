<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* ------------------------------------------------------------------------
|	Base controller for Admin
// ------------------------------------------------------------------------

/**
 * Admin Class
 *
 * Extends Controller
 *
 */

class Admin_Controller extends MY_Controller
{
    function __construct()
	{
		parent::__construct();
		
		$this->is_allowed(array('login'));
    }
	
	// --------------------------------------------------------------------
	
	private function is_allowed($excluded_pages = array())
	{
		$page = $this->uri->segment(2, 'index');
	
		if (!in_array($page, $excluded_pages))
		{
			if (!$this->simpleloginsecure->is_logged_in_admin())
			{
				redirect('admin/login');
			}
		}
	}

	// --------------------------------------------------------------------
}

/* End of file Admin_Controller.php */
/* Location: ./application/libraries/base_controllers/Admin_Controller.php */