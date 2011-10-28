<?php /* JavaScript at the bottom for fast page loading */ ?>
<?php /* Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary */ ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js"></script>
<script>window.jQuery || document.write("<script src='/_/js/libs/jquery-1.6.4.min.js'>\x3C/script>")</script>

<?php /* scripts concatenated and minified via ant build script */ ?>
<script src="/_/js/plugins.js?<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/_/js/plugins.js'); ?>"></script>
<script src="/_/js/script.js?<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/_/js/script.js'); ?>"></script>
<?php /* end scripts */ ?>

<?php
// only output google analytic code live site
if ("${_SERVER['HTTP_HOST']}" == 'your-live-domain-here'): // e.g. crashouts.com
?>
<?php /* Add you Google Analytics code into the SetAccount value */ ?>
<script>
	var _gaq=[["_setAccount","UA-xxxxxxxxxxxxxxxxx"],["_trackPageview"]];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
		s.parentNode.insertBefore(g,s)}(document,"script"));
</script>
<?php endif; ?>
