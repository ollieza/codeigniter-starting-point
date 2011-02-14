<?php
$this->load->view('templates/admin/header');  

if ($this->simpleloginsecure->is_logged_in_admin()) 
{ 
	$this->load->view('templates/admin/top_message');
}	
  
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

$this->load->view('templates/admin/footer');
?>