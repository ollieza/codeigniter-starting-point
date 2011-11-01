<!doctype html>
<?php /* paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ */ ?>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<?php /* Consider adding a manifest.appcache: h5bp.com/d/Offline */ ?>
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php
$this->load->view('templates/default/head', $this->data);
echo generate_body_tag($body_id, $body_class)."\n\t";
echo '<div class="container clearfix">' . "\n\t";
$this->load->view('templates/default/header', $this->data);
echo '<div id="main" role="main" class="clearfix">' . "\n\t";

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
	
echo '</div>' . "\n";
$this->load->view('templates/default/footer', $this->data);
echo '</div>' . "\n";
$this->load->view('templates/default/footer_js', $this->data);
echo '</body>' . "\n";
?>
</html>
