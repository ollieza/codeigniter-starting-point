<?php

$this->load->view('templates/frontend/header');

// displays message set by previous page
display_flashdata();

if (is_array($path))
{
	foreach($path as $value)
	{
		$this->load->view($path);
	}
}
else
{
	$this->load->view($path);
}
	
$this->load->view('templates/frontend/footer');
?>