<?php

class Password_reset_model extends CI_Model { 

	// Protected or private properties
	protected $_table;
	
	// Constructor
	public function __construct()
	{
		$this->_table = $this->config->item('database_tables');
	}
	
	// --------------------------------------------------------------------

	function get_user_id_from_reset_code($reset_code = NULL)
	{	
		// AND UNIX_TIMESTAMP(created) >= (UNIX_TIMESTAMP(CURRENT_DATE) - 1296000)
		// currently not working. Think it is because it is stored as a datetime
		// Could do this outside of SQL if necessary
	
		// Less than 15 days old
		$query = $this->db->query("SELECT *
									FROM ".$this->_table['users_password_reset']."
									WHERE password_reset_code = ".$this->db->escape($reset_code)."");

		if ($query->num_rows == 1)
		{
			$user = $query->row();
			return $user->user_id;
		}
	
		return FALSE;
	}
	
	// --------------------------------------------------------------------

	function save_reset_password($user_id = NULL, $password = NULL)
	{
		$this->db->trans_start();
		
		$this->db->where('user_id', $user_id);
		$this->db->update($this->_table['users'], array('user_pass' => $password));
	
		// delete reset code
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->_table['users_password_reset']);
	
		$this->db->trans_complete();
	
		if ($this->db->trans_status() === FALSE)
		{
		    return FALSE;
		}
	
		return TRUE;
	}
	
	// --------------------------------------------------------------------

	function create_reset_code($user_id = NULL)
	{
		$this->db->trans_start();
	
		// remove any existing reset codes for this user_id avoids clutter
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->_table['users_password_reset']);
	
		$unique = FALSE;
		$loop = 1;

		while($unique == FALSE)
		{
			// generate a reset code
			$reset_code =  $new_pass = random_string('alnum', 50);        
	
			// Run a query to make sure that this reset code is unique
			$query = $this->db->query("SELECT password_reset_code  	
										FROM ".$this->_table['users_password_reset']."
										WHERE password_reset_code = ".$this->db->escape($reset_code)."");
		
			if ($query->num_rows == 0)
			{
				$unique = TRUE;
			}
			$loop++;
		}
	
		// insert new reset code
		$datetime = date('c');
		$this->db->insert($this->_table['users_password_reset'], array('password_reset_code' =>  $reset_code, 'user_id' => $user_id, 'password_reset_date' => $datetime));
	
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
		    return FALSE;
		}

		return $reset_code;
	}
	
	// --------------------------------------------------------------------	
}
?>