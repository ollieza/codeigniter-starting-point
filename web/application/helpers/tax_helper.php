<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// UK VAT calculations using the VAT_RATE defined in config/constants.php

define('VAT_RATE', 15);

// --------------------------------------------------------------------	

function add_vat($price = NULL)
{
	if ($price == NULL)
	{
		return FALSE;
	}
	
	$CI =& get_instance();

	return number_format(round($price * ((VAT_RATE / 100) + 1), 2), 2, '.', '');
}

// --------------------------------------------------------------------	

function get_vat($price = NULL)
{
	if ($price == NULL)
	{
		return FALSE;
	}
	
	$CI =& get_instance();
	
	return number_format(round($price * ((VAT_RATE / 100) + 1), 2), 2, '.', '');
}

// --------------------------------------------------------------------

function format_decimal_places($price = NULL, $number_of_places = 2)
{
	return number_format($price, $number_of_places, '.', '');
}

// --------------------------------------------------------------------

/* End of file tax_helper.php */
/* Location: ./application/helpers/tax_helper.php */