<?php

/*	
| -------------------------------------------------------------------------
| Admin - Dashboard
| -------------------------------------------------------------------------
*/

class Dashboard extends Admin_Controller
{	
    public function __construct()
    {
        parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	function index()
	{
		build_page('admin/dashboard/index/index', NULL, 'Admin dashboard');
	}

	// --------------------------------------------------------------------

}
?>