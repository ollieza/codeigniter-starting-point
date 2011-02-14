<?php
 
/*
| -------------------------------------------------------------------------
| Crud model - generic functions
| -------------------------------------------------------------------------
*/

class Crud_model extends Model {
	
	// Constructor
	public function __construct()
	{
		parent::Model();
	}
 
	// --------------------------------------------------------------------	
	
	function update($table = NULL, $id_fieldname = NULL, $id_value = NULL, $data = array())
	{
		$this->db->where($id_fieldname, $id_value);
		$this->db->update($table, $data);
 
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
 
		return FALSE;
	}
	
	// --------------------------------------------------------------------		
		
	function insert($table = NULL, $data = array())
	{
		$this->db->insert($table, $data);
 
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
 
		return FALSE;
	}

	// --------------------------------------------------------------------	
		
	function deactivate($table = NULL, $id_fieldname = NULL, $id_value = NULL)
	{
		$this->db->where($id_fieldname, $id_value);
		$this->db->update($table, array('active' => '0'));
 
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
 	
		return FALSE;
	}
	
	// --------------------------------------------------------------------	
	
	function delete($table = NULL, $where_array = array())
	{
		$this->db->delete($table, $where_array);
 
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
 
		return FALSE;
	}

	// --------------------------------------------------------------------	
?>