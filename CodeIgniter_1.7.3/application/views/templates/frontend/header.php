<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $page_title.' | '.WEBSITE_NAME; ?></title>
	<meta name="keywords" content="<?php echo $meta_keywords; ?>" />
	<meta name="description" content="<?php echo $meta_description; ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets/css/frontend/core.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascripts/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascripts/json.js"></script>
</head>

<?php echo generate_body_tag($body_id, $body_class); ?>

<div id="page-wrapper">
	<div class="header">
		<div id="logo">
			<a href="<?php echo base_url(); ?>"><?php echo WEBSITE_NAME; ?></a>
		</div>
	</div>
	
	<div id="main-wrapper">