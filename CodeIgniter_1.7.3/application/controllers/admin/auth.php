<?php

class Auth extends Controller
{
 	public function __construct()
    {
        parent::__construct();
    }
	
	// --------------------------------------------------------------------
	
	function login()
	{
		if ($this->simpleloginsecure->is_logged_in_admin()) 
		{ 
			redirect('admin'); 
		}

       $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
       $this->form_validation->set_rules('password', 'password', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE) 
		{ 		
			build_page('admin/auth/login/form');
		} 
		else 
		{
			$user_email = set_value('email');
			$user_pass = set_value('password');
			
			if ($this->simpleloginsecure->login($user_email, $user_pass))
			{
				$this->session->set_flashdata( 'flash', "Login successful. Welcome", 'success');
			}
			else
			{
				$this->session->set_flashdata( 'flash', 'Login unsuccessful', 'error');
				sleep(5);
			}
			
			redirect('admin');
		}
	}
	
	// --------------------------------------------------------------------
	
	function logout ()
	{
		$this->simpleloginsecure->logout();
		redirect('admin/login');
	}
	
	// --------------------------------------------------------------------
}
?>