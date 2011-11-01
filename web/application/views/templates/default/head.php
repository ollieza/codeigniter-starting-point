<head>
	<meta charset="utf-8">
	<title><?php echo WEBSITE_NAME ?> - <?php echo $page_title; ?></title>
	<meta name="description" content="<?php echo META_DESCRIPTION; ?>" />
	<meta name="keywords" content="<?php echo META_KEYWORDS; ?>" />

	<?php /* Mobile viewport optimized: j.mp/bplateviewport */ ?>
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<?php /* CSS: implied media="all" */ ?>
	<link rel="stylesheet" href="/_/css/style.css?<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/_/css/style.css'); ?>">
	<?php /* More ideas for your <head> here: h5bp.com/d/head-Tips */ ?>
	<?php if( $body_id != 'Login' ): ?>
	<?php /* All JavaScript at the bottom, except this Modernizr build incl. Respond.js
			 Respond is a polyfill for min/max-width media queries. Modernizr enables HTML5 elements & feature detects;
			 for optimal performance, create your own custom Modernizr build: www.modernizr.com/download/ */ ?>
		<script src="/_/js/libs/modernizr-2.0.6.min.js"></script>
	<?php endif; ?>
</head>
