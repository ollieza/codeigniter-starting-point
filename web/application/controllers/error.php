<?php

class Error extends Frontend_Controller {
    
	public function __construct()
	{
		parent::__construct();
    }

    // --------------------------------------------------------------------
    
    function error_404()
    {
        header("HTTP/1.1 404 Not Found");

		build_page('error/error_404', NULL, '404 Page not found', 'Page', 'error_404');
    }

    // --------------------------------------------------------------------
}

/* End of file error.php */
/* Location: ./application/controllers/error.php */