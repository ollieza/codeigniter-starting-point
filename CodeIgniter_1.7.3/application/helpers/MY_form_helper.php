<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------	

# Custom function to set checkboxes based on boolean setting in db

function selected_checkbox($boolean = 0)
{
	if ($boolean == TRUE)
	{
		return 'checked="checked"';
	}
}

// --------------------------------------------------------------------

function selected_radio($field_value = NULL, $value = NULL)
{
	if ($field_value == $value)
	{
		return 'checked="checked"';
	}
}

// --------------------------------------------------------------------	

function selected($field_value = NULL, $value = NULL)
{
	if ($field_value == $value)
	{
		return 'selected';
	}
}

// --------------------------------------------------------------------	

function db_checkbox($array = NULL, $db_field = NULL)
{
	if (!is_array($array))
	{
		return 0;
	}
	
	foreach($array as $key => $value)
	{
		if ($value == $db_field)
		{
			return 1;
		}
	}
	
	return 0;
}

// --------------------------------------------------------------------

function create_inventory_options()
{
	$inventories[''] = '0';
	
	for ($i = 1; $i <= 999; $i++) 
	{
		$inventory = str_pad($i, 2, '0', STR_PAD_LEFT);
		$inventories[$inventory] = $inventory;
	}
	
	return $inventories;
}

// --------------------------------------------------------------------

/* End of file MY_form_helper.php */
/* Location: ./application/helpers/MY_form_helper.php */