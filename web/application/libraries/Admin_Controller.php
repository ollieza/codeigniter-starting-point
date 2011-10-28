<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* ------------------------------------------------------------------------
|	Base controller for Admin
| ------------------------------------------------------------------------
*/

class Admin_Controller extends MY_Controller
{
    function __construct()
	{
		parent::__construct();
		
		// Check to see if a user is logged in
		if (!$this->simpleloginsecure->is_logged_in_admin())
		{
			redirect('admin/login');
		}
    }
	
	// --------------------------------------------------------------------
}

/* End of file Admin_Controller.php */
/* Location: ./application/libraries/Admin_Controller.php */