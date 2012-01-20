<?php

class MY_Session extends CI_Session
{
	function __construct()
    {
        parent::__construct();
    }

	// --------------------------------------------------------------------
	
	/**
	 * Add or change flashdata, only available
	 * until the next request
	 * Modified to print out <div> with success or error css class
	 * and the data key is always set to 'message'
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */
	
	public function set_flashmessage($val = NULL, $type = NULL)
	{
		if ($val) // ensures we don't get empty messages
		{
			if ($type == 'success')
			{
				$val = '<div class="flash_success">'.$val.'</div>';
			}

			if ($type == 'error')
			{
				$val = '<div class="flash_error">'.$val.'</div>';
			}
			
			$this->set_flashdata('message', $val, $type);
		}
	}
	
	// --------------------------------------------------------------------	
}
?>