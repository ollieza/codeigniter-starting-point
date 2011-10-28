<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------

// Outputs an array of the 60 minutes

function list_minutes()
{
	$minutes[''] = 'Minute';
	
	for ($m = 0; $m <= 60; $m++) 
	{
		$minute = str_pad($m, 2, '0', STR_PAD_LEFT);
		$minutes[$minute] = $minute;
	}
	
	return $minutes;
}

// --------------------------------------------------------------------

// Outputs an array of the 24 hours

function list_hours() 
{
	$hours[''] = 'Hour';
	
	for ($h = 1; $h <= 24; $h++) 
	{
		$hour = str_pad($h, 2, '0', STR_PAD_LEFT);
		$hours[$hour] = $hour;
	}
	
	return $hours;
}

// --------------------------------------------------------------------

function list_days()
{
	$days[''] = 'D';
	
	for ($d = 1; $d <= 31; $d++) 
	{
		$day = str_pad($d, 2, '0', STR_PAD_LEFT);
		$days[$day] = $day;
	}
	
	return $days;
}

// --------------------------------------------------------------------

function list_months()
{
	return array(
				'' 	 => 'M',
     	        '01' => 'Jan',
                '02' => 'Feb',
                '03' => 'Mar',
                '04' => 'Apr',
                '05' => 'May',
                '06' => 'Jun',
                '07' => 'Jul',
                '08' => 'Aug',
                '09' => 'Sep',
                '10' => 'Oct',
                '11' => 'Nov',
                '12' => 'Dec'
				);
}

// --------------------------------------------------------------------

// Outputs an array of the last 100 years

function list_years_past($quantity = 100)
{
   	$years[''] = 'Y';
   	
	for ($y = date('Y'); $y >= date('Y')-$quantity; $y--) 
	{
		$years[$y] = $y;
	}
   	
	return $years;
}

// --------------------------------------------------------------------

// Outputs an array of the next 10 years

function list_years_future($quantity = 10)
{
	$years[''] = 'Y';
	
	for ($y = date('Y'); $y <= date('Y')+$quantity; $y++) 
	{
		$years[$y] = $y;
	}
	
	return $years;
}

// --------------------------------------------------------------------

/* End of file time_helper.php */
/* Location: ./application/helpers/time_helper.php */