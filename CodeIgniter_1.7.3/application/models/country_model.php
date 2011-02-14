<?php
 
/*
| -------------------------------------------------------------------------
| Country model
| -------------------------------------------------------------------------
*/

class Country_model extends Model {
 
	// Protected or private properties
	protected $_table;
	
	// Constructor
	public function __construct()
	{
		parent::Model();
		$this->_table = $this->config->item('database_tables');
	} 

	// --------------------------------------------------------------------
	
	function get_select_options()
	{
		$query = $this->db->query("SELECT *
								  FROM {$this->_table['countries']}
								  WHERE 1
								  ORDER BY country_name ASC"
								  );
		
		$countries_list = array();

		if ($query->num_rows() > 0)
		{
			$countries_list[''] = 'Please select';
			$countries_list['GB'] = 'United Kingdom';
			$countries_list[' '] = '------------';
	
			foreach ($query->result() as $country)
			{
				$countries_list[$country->country_iso] = $country->country_printable_name;
			}
		}
	
		$query->free_result();
		return $countries_list;
	}

	// --------------------------------------------------------------------	
}
?>