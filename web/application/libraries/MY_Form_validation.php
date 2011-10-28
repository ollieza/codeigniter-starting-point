<?php
/**
 * MY_Form_validation Class
 *
 * This library extends the native Form validation library.
 * It adds a custom callback rule
 *
 * @package		CodeIgniter
 * @subpackage 	Libraries
 * @category 	Forms
 * @author 		Ollie Rattue
 */

class MY_Form_validation extends CI_Form_validation
{

    function __construct()
    {
        parent::__construct();

		$this->CI =& get_instance();
    }
	
	// --------------------------------------------------------------------
	
	/**
	 * Greater than or equal - Custom callback form validation rule
	 *
	 * @access	public
	 * @param	string
	 * @param	value
	 * @return	bool
	 */	
	
	function greater_than_or_equal($str = NULL, $val = NULL)
	{
	    if ($str < $val)
	    {
	        return FALSE;
	    }
	    else
	    {
	        return TRUE;
	    }
	}

	// --------------------------------------------------------------------
	
	// Checks whether the email address is available i.e. not already signed up
	
	function email_available($str = NULL)
	{
		$is_ajax = FALSE;
	
		if ($_POST && $this->CI->input->post('is_ajax') == 1 && trim($this->CI->input->post('str')) != NULL) 
		{
			$str = trim($this->input->post('str'));
			$is_ajax = TRUE;
		}
		
		if (!$this->CI->simpleloginsecure->is_email_available($str))
		{
			if (!$is_ajax) 
			{
				$this->set_message('email_available', "The email address {$str} has already been registered, please try a different email address.");
				return FALSE;
			}
			else
			{
				if ($this->CI->session->userdata('user_email') == $str) // when someone tabs to confirm field without changing their current email address
				{
					$email_available_message = 'No change made...';
				}
				else
				{
					$email_available_message = '<span class="error">The email address '.$str.' is taken please try a different email address.</span>';
				}

				$result = array('result' => $email_available_message);
				echo json_encode($result);
			}
		}
		else
		{
			if (!$is_ajax) 
			{
				return TRUE;
			}
			else
			{	
				if (!valid_email($str))
				{
					$email_available_message = '<span class="error">Please enter a valid email address.';
				}
				else
				{
					$email_available_message = "The email address {$str} is available.";
				}

				$result = array('result' => $email_available_message);
				echo json_encode($result);
			}
		}
	}

	// --------------------------------------------------------------------
	
	function current_password_check($str = NULL)
	{
		if (!$this->CI->simpleloginsecure->verify_current_password($this->CI->session->userdata('user_id'), $str))
		{
			$this->set_message('current_password_check', language('current_password_check_error'));
			return FALSE;
		}
		
		return TRUE;		
	}

	// --------------------------------------------------------------------
}