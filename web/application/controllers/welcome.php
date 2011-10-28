<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();
	}	

	// --------------------------------------------------------------------
	
	public function index()
	{
		build_page('welcome/welcome_index', $this->data);
	}
	
	// --------------------------------------------------------------------
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */