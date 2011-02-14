<?php

/*
| -------------------------------------------------------------------------
| Amnesia
| -------------------------------------------------------------------------
*/

class Amnesia extends Controller
{
	public function __construct()
    {
        parent::__construct();
		// Changed clienty name to be exactly same as it on the server.
		$this->load->model('SimpleLoginSecure/users_model', 'users_model');
  	}

	// --------------------------------------------------------------------

    function forgot_password()
    {
		$this->form_validation->set_rules('email','Email address','trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		
    	if( $this->form_validation->run() == FALSE ) 
    	{	
    		build_page('amnesia/forgot_password/form', NULL, 'Reset your password','Members','details');	
    	} 
    	else 
    	{ 
			$user_email = set_value('email');
			
			if (!$this->simpleloginsecure->is_email_registered($user_email))
			{
				$this->session->set_flashdata( 'flash', language('flash_error_incorrect_email'), 'error');
     			redirect('amnesia/forgot_password');	
			}

			// Save code/user_id/date to db
			if (!$this->simpleloginsecure->reset_password($user_email))
			{
				$this->session->set_flashdata( 'flash', language('flash_error_reset_password_general_problem'), 'error');
    			redirect('amnesia/forgot_password');	
			}
				
     		build_page('amnesia/forgot_password/reset_code_sent');
     	}
    }

	// --------------------------------------------------------------------
	
	function reset_password($reset_code = NULL)
	{
		// run a function to check reset_id matches and we are within 15 days of reset code being issued

		if (!$this->simpleloginsecure->valid_reset_code($reset_code))
		{
			$this->session->set_flashdata( 'flash', language('flash_error_reset_code_incorrect_or_expired'), 'error');
			redirect('amnesia/forgot_password');
		}
		
		$this->form_validation->set_rules('new_password','New Password','required|trim|xss_clean');			
		$this->form_validation->set_rules('new_password_confirm','New Password Confirm','required|trim|matches[new_password]|xss_clean');

		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

		if ($this->form_validation->run() == FALSE)
		{
			if (!empty($_POST))
			{
					$this->session->set_flashdata( 'flash', language('flash_error_password_match'), 'error');
					redirect( 'amnesia/reset_password/'.$reset_code );	
			}
			
			$data['reset_code'] = $reset_code;
			build_page('amnesia/reset_password/form',$data);
		}
		else // passed validation proceed to post success logic
		{
			if ($this->simpleloginsecure->save_new_reset_password($reset_code, set_value('new_password')))
			{
				// Redirect to login as safer than auto-login
				$this->session->set_flashdata( 'flash', language('flash_success_password_reset'), 'success');
			}
			else
			{
				$this->session->set_flashdata( 'flash', language('flash_error_reset_code_auto_login'), 'error');					
			}
			
			redirect('admin/dashboard');
		}
	}
	
	// --------------------------------------------------------------------
}
?>