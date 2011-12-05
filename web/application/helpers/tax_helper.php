<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------

function add_tax($price = NULL, $percentage = NULL)
{
	if (!$price)
	{
		return format_price(0);
	}
	
	if (!$percentage)
	{
		return format_price(0);
	}
	
	return format_price($price * (($percentage / 100) + 1));
}

// --------------------------------------------------------------------

function get_tax($price = NULL, $percentage = NULL)
{
	if (!$price)
	{
		return format_price(0);
	}
	
	if (!$percentage)
	{
		return format_price(0);
	}
	
	return format_price($price * ($percentage / 100));
}

// --------------------------------------------------------------------

function format_price($price = 0)
{
	return number_format($price, 2, '.', '');
}

// --------------------------------------------------------------------

function clean_percentage($num)
{
	return trim(trim($num, '0'), '.');
}

// --------------------------------------------------------------------

/* End of file tax_helper.php */
/* Location: ./application/helpers/tax_helper.php */