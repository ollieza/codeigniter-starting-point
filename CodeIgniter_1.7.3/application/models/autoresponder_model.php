<?php

class Autoresponder_model extends Model { 

	// Protected or private properties
	protected $_table;
	
	// Constructor
	public function __construct()
	{
		parent::Model();
		$this->_table = $this->config->item('database_tables');
	}
	
	// --------------------------------------------------------------------

	function get($autoresponder_name = NULL) 
	{
		$this->db->select('*');
       	$this->db->from($this->_table['autoresponders']);
      	$this->db->where('autoresponder_name', $autoresponder_name);
       	return $this->db->get();   
	}
	
	// --------------------------------------------------------------------
	
	function log_email($data = array())
	{
        $this->db->insert($this->_table['autoresponder_log'], $data);
 
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
 
		return FALSE;
    }
	
	// --------------------------------------------------------------------
}
?>