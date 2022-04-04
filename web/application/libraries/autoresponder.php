<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * Autoresponder class
 * Sends emails using templates stored in database
 *
 * @package   autoresponder
 * @version   1.0
 * @license   http://www.opensource.org/licenses/mit-license.php
 */

class Autoresponder {

	var $config;
	var $CI;
	var $to_name = NULL;
	var $to_email = NULL;
	var $reply_email = NULL;
	var $variable_values = array();
	var $bcc_notify = FALSE;
	var $attachments = array();
	var $dump = FALSE;
	var $mailtype = 'html';
	var $charset = 'utf-8';
	var $wordwrap = TRUE;
	
	function Autoresponder()
	{
		// Load CI instance so we can get config values etc
		$this->CI =& get_instance();

		// Load config		
		$this->CI->load->config('autoresponderlib_config', TRUE);
		$this->config = $this->CI->config->item('autoresponderlib_config');
		
		$this->CI->load->helper('email'); // used for valid_email function
		$this->CI->load->model('autoresponder_model');

		$this->from_name = $this->config['autoresponder_from_name'];
		$this->from_email = $this->config['autoresponder_from_email'];
		$this->autoresponders_enable = $this->config['autoresponder_enable'];	
		$this->bcc_notification_email = $this->config['autoresponder_bcc_notification_email'];
		$this->mailtype = $this->config['autoresponder_mailtype'];
		$this->charset = $this->config['autoresponder_charset'];
		$this->wordwrap = $this->config['autoresponder_wordwrap'];
	}

	// --------------------------------------------------------------------

	function to_email($to_email = NULL)
	{
		$this->to_email = $to_email;
	}

	// --------------------------------------------------------------------

	function to_name($to_name = NULL)
	{
		$this->to_name = $to_name;
	}	

	// --------------------------------------------------------------------

	function from_email($from_email = NULL)
	{
		$this->from_email = $from_email;
	}

	// --------------------------------------------------------------------

	function from_name($from_name = NULL)
	{
		$this->from_name = $from_name;
	}	

	// --------------------------------------------------------------------

	function reply_email($reply_email = NULL)
	{
		$this->reply_email = $reply_email;		
	}

	// --------------------------------------------------------------------
	
	function variable_values($variable_values = array())
	{
		$this->variable_values = $variable_values;
	}

	// --------------------------------------------------------------------

	function bcc_notify()
	{
		$this->bcc_notify = TRUE;
	}

	// --------------------------------------------------------------------

	function attachments($attachments = array())
	{
		$this->attachments = $attachments;
	}

	// --------------------------------------------------------------------

	function dump($autoresponder_name = NULL)
	{
		$this->dump = TRUE;
		return $this->send($autoresponder_name);
	}	

	// --------------------------------------------------------------------

	/**
	 * 	Send
	 *	@param INT - refers to autoresponder_id in database
	 *  @param string - valid email address
	 *  @param string 
	 *  @param array
	 *  @param bool
	 *  @param bool
	 *	@return bool
	 */

	function send($autoresponder_name = NULL) 
	{
		if (!$this->dump && !$this->autoresponders_enable) 
		{
			return TRUE;
		}
		
		// check to see that we received some parameters
		if (!$this->dump && (!$autoresponder_name || !valid_email($this->to_email)))
		{
			return FALSE;
		}

		// Get the autoresponder from the database
		$autoresponder_result = $this->CI->autoresponder_model->get($autoresponder_name);

		if ($autoresponder_result->num_rows() == 0) 
		{
			log_message('error', 'Autoresponder send() failed to get info from the db.');
			return FALSE;
		}

		$autoresponder = $autoresponder_result->row();

		// Add % to substition value keys
		$this->variable_values_temp = array();

		foreach($this->variable_values as $key => $value)
		{
			$this->variable_values_temp["%{$key}"] = $value;
		}

		$this->variable_values = $this->variable_values_temp;

		// What does this code segment do???
		// ----------------------------------->
		preg_match('/\{repeat\}([^\{]*)\{\/repeat\}/i', $autoresponder->autoresponder_message, $repeatBlock);

		if (!empty($repeatBlock))
		{
			$repeatContent = $repeatBlock[1];
			$repeatResult = '';

			foreach($variable_values['repeat'] as $k => $v)
			{
				$repeatResult .= str_replace(array_keys($v), array_values($v), $repeatContent);
			}

			unset($variable_values['repeat']);

			$autoresponder->autoresponder_message = str_replace($repeatBlock[0], $repeatResult, $autoresponder->autoresponder_message);
		}
		// <-----------------------------------

		// substitute the array values for the saved placeholder values
		$subject = str_replace(array_keys($this->variable_values), array_values($this->variable_values), $autoresponder->autoresponder_subject);
		$message = str_replace(array_keys($this->variable_values), array_values($this->variable_values), $autoresponder->autoresponder_message);

		// Send the email
		$config = array();
		$config['charset'] = $this->charset;
		$config['mailtype'] = $this->mailtype;
		$config['wordwrap'] = $this->wordwrap;
		
		// Used for debugging
		if ($this->dump)
		{
			$email_dump = array(
							'subject' 	=> $subject,
	            			'message' 	=> $message
	        				);

			return $email_dump;
		}
		
		if ($this->config['autoresponder_use_smtp'] == TRUE)
		{
			$config['protocol'] = $this->config['autoresponder_protocol'];
			$config['smtp_host'] = $this->config['autoresponder_smtp_host'];
			$config['smtp_port'] = $this->config['autoresponder_smtp_port'];
			$config['smtp_user'] = $this->config['autoresponder_smtp_user'];
			$config['smtp_pass'] = $this->config['autoresponder_smtp_pass'];
			$config['smtp_timeout'] = $this->config['autoresponder_smtp_timeout'];
		}
		
		$this->CI->load->library('email', $config);
		
		$this->CI->email->clear();
		$this->CI->email->set_newline("\r\n");
		$message = str_replace("\n", "\r\n", $message);
		
		$this->CI->email->from($this->from_email, $this->from_name);
		
		if ($this->to_name)
		{
			$this->CI->email->to($this->to_email, $this->to_name);
		}
		else
		{
			$this->CI->email->to($this->to_email);
		}
		
		if ($this->bcc_notify) 
		{
			$this->CI->email->bcc($this->bcc_notification_email);
		}

		if ($this->reply_email)
		{
			$this->CI->email->reply_to($this->reply_email);			
		}
		
		$this->CI->email->subject($subject);
		
		if ($this->mailtype == 'html')
		{
			$this->CI->email->set_alt_message(strip_tags($message));
			
			$message = $this->nl2p($message);
			$message = "<html><body>{$message}</html></body>";
		}

		$this->CI->email->message($message);

		if ($this->attachments) 
		{
			foreach ($this->attachments as $key => $file_path) 
			{
				$this->CI->email->attach($file_path);
			}
		}

		$email_sent = $this->CI->email->send();

		$autoresponder_log = array();
		$autoresponder_log['autoresponder_id'] = $autoresponder->autoresponder_id;
		$autoresponder_log['autoresponder_log_to_email'] = $this->to_email;

		if ($this->to_name)
		{
			$autoresponder_log['autoresponder_log_to_name'] = $this->to_name;	
		}

		$autoresponder_log['autoresponder_log_from_email'] = $this->from_email;
		$autoresponder_log['autoresponder_log_from_name'] = $this->from_name;
		$autoresponder_log['autoresponder_log_subject'] = $subject;
		$autoresponder_log['autoresponder_log_message'] = $message;
		$autoresponder_log['autoresponder_log_substitution_array'] = serialize($this->variable_values);
		$autoresponder_log['autoresponder_log_attachments_array'] = serialize($this->attachments);
		$autoresponder_log['autoresponder_log_bcc_notify'] = $this->bcc_notify;

		if ($email_sent)
		{
			$autoresponder_log['autoresponder_log_email_sent'] = 1;
		}
		else
		{
			$autoresponder_log['autoresponder_log_email_sent'] = 0;
			log_message('error', "Autoresponder send() failed to send an email - $autoresponder->autoresponder_id");               
		}

		$this->CI->autoresponder_model->log_email($autoresponder_log);

		return $email_sent;
	}

	// --------------------------------------------------------------------
	
	// http://tycoontalk.freelancer.com/php-forum/151623-php-nl2p-one-problem.html#post759987

	function nl2p($string = NULL)
	{
	    $string = "<p>" . $string . "</p>";
	    $string = preg_replace("/\r\n\r\n/", "</p>\n\n<p>", $string);
	    $string = preg_replace("/\r\n/", "<br />", $string);
	    return $string;
	}

	// --------------------------------------------------------------------
}

/* End of file autoresponder.php */
/* Location: ./application/libraries/autoresponder.php */
