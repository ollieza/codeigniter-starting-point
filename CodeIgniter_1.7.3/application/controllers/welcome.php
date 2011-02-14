<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	// --------------------------------------------------------------------

    function index()
    {
		build_page('welcome/index/index', NULL, 'Homepage');
	}
	
	// --------------------------------------------------------------------
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */