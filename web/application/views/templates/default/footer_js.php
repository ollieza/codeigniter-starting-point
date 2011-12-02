<?php /* JavaScript at the bottom for fast page loading */ ?>
<?php /* Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary */ ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src='/_/js/libs/jquery-1.7.1.min.js'>\x3C/script>")</script>

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
	window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
	Modernizr.load({
		load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
	});
</script>
<?php endif; ?>
