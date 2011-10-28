<?php
/**
 * MY_Log Class
 *
 * This library extends the native Log library.
 * It adds the function to have the log messages being emailed when they have been outputted to the log file.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Logging
 * @author		Johan Steen
 * @link		http://coding.cglounge.com/ 
 */

class MY_Log extends CI_Log
{
	 function __construct()
	 {
	     parent::__construct();
	 }

	// --------------------------------------------------------------------

	/**
	 * Write Log File
	 *
	 * Calls the native write_log() method and then sends an email if a log message was generated.
	 *
	 * @access	public
	 * @param	string	the error level
	 * @param	string	the error message
	 * @param	bool	whether the error is a native PHP error
	 * @return	bool
	 */	

	function write_log($level = 'error', $msg, $php_error = FALSE)
	{
		$result = parent::write_log($level, $msg, $php_error);
 
		if ($result == TRUE && strtoupper($level) == 'ERROR' && EMAIL_ERROR_LOG == TRUE) 
		{
			$message = "An error occurred: \n\n";
			$message .= $level.' - '.date($this->_date_fmt). ' --> '.$msg."\n";
 
			$to = DEVELOPER_EMAIL;
			$subject = 'An error has occured on apps';
			$headers = 'From: '.WEBSITE_NAME.' system <'.SYSTEM_EMAIL.'>' . "\r\n";
			$headers .= 'Content-type: text/plain; charset=utf-8\r\n'; 
 
			@mail($to, $subject, $message, $headers);
		}
		
		return $result;
	}
	
	// --------------------------------------------------------------------
}
?>