<?php
 
/*
| -------------------------------------------------------------------------
| Options model
| -------------------------------------------------------------------------
*/

class Options_model extends Model {
 
	// Protected or private properties
	protected $_table;
	
	// Constructor
	public function __construct()
	{
		parent::Model();
		$this->_table = $this->config->item('database_tables');
	} 

	// --------------------------------------------------------------------
	
	function get($option_name = NULL)
	{
		$this->db->select('option_value');
       	$this->db->from($this->_table['options']);

       	if ($option_name)
       	{
			$this->db->where('option_name', $option_name);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0)
			{
				$option = $query->row();

				return $option->option_value;
			}
			
			return FALSE;
       	}			
		
		return $this->db->get();
	}
	
	// --------------------------------------------------------------------	

	function save($options = array())
	{
		foreach($options as $option_name => $option_value)
		{
			$this->db->where('option_name', $option_name);
			$this->db->update($this->_table['options'], array('option_value' => $option_value));
		}

		return TRUE;
	}

	// --------------------------------------------------------------------	
}
?>