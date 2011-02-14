<?php
/**
 * MY_Form_validation Class
 *
 * This library extends the native Form validation library.
 * It adds a custom callback rule
 *
 * @package	CodeIgniter
 * @subpackage Libraries
 * @category Forms
 * @author Ollie Rattue
 */

class MY_Form_validation extends CI_Form_validation {
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function MY_Form_validation()
	{
		parent::CI_Form_validation();
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
	
	function greater_than_or_equal($str, $val)
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
}
?>