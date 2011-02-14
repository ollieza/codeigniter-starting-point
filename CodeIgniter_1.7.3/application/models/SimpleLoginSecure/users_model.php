<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends Model { 

	// Protected or private properties
	protected $_table;
	
	// Constructor
	public function __construct()
	{
		parent::Model();
		$this->_table = $this->config->item('database_tables');
	}
	
	// --------------------------------------------------------------------

	function get_user_by_id($user_id = NULL)
	{
		$this->db->where('user_id', $user_id);
		return $this->db->get($this->_table['users']);
	}
	
	// --------------------------------------------------------------------

	function get_user_by_username($username = NULL)
	{
		$this->db->where('user_username', $username);
		return $this->db->get($this->_table['users']);
	}
	
	// --------------------------------------------------------------------
	
	function get_user_by_email($email = NULL)
	{
		$this->db->where('user_email', $email);
		return $this->db->get($this->_table['users']);
	}
	
	// --------------------------------------------------------------------

	function get_userid_from_email($email = NULL)
	{
		$this->db->where('user_email', $email);
		$query = $this->db->get($this->_table['users']);
		
		if ($query->num_rows == 1)
		{
			$user = $query->row();
			return $user->user_id;
		}

		return FALSE;
	}

	// --------------------------------------------------------------------
	
	function get_email_from_userid($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get($this->_table['users']);
		
		if ($query->num_rows == 1)
		{
			$user = $query->row();
			return $user->user_email;
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	function get_user($username_or_email)
	{
		$this->db->or_where('user_username', $username_or_email);
		$this->db->or_where('user_email', $username_or_email);
		$query = $this->db->get($this->_table['users']);

		return $query;
	}

	// --------------------------------------------------------------------

	function update_user($user_array = NULL, $action = 'add', $user_id = NULL)
	{
		if ($action == 'add')
		{
			$this->db->insert($this->_table['users'], $user_array);
		} 
		
		if ($action == 'edit') 
		{
			$this->db->where('user_id', $user_id);
			$this->db->update($this->_table['users'], $user_array);
		}
						  
		if ($this->db->affected_rows() == '1')
		{
			if ($action == 'add')
			{
				return $this->db->insert_id();      
			}
			
			return TRUE;  
		} 
	
		return FALSE;
	}

	// --------------------------------------------------------------------

	function delete_user($user_id = NULL)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->_table['users']);
						  
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;           
		} 
	
		return FALSE;
	}

	// --------------------------------------------------------------------
	
    function get_all_users()
	{
        $sSql = "SELECT * FROM users";
        $query = $this->db->query($sSql);
        return $query->result();
    }

	// --------------------------------------------------------------------
}
?>