<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

		/*************************************************************
			Profiler
		*************************************************************/

		if (ENABLE_PROFILER)
		{
			$this->output->enable_profiler(TRUE);
		}
		
		$this->data['user_id'] = $this->session->userdata('user_id');
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/libraries/MY_Controller.php */