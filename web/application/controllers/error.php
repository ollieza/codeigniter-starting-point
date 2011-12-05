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

		$this->template->page_title('404 Page not found');
		$this->template->body_id('Page');
		$this->template->body_class('error_404');
		$this->template->build_page('error/error_404', NULL);
    }

    // --------------------------------------------------------------------
}

/* End of file error.php */
/* Location: ./application/controllers/error.php */