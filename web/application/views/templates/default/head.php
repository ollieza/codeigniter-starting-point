<head>
	<meta charset="utf-8">
	<title><?php echo WEBSITE_NAME ?> - <?php echo $page_title; ?></title>
	<meta name="description" content="<?php echo META_DESCRIPTION; ?>" />
	<meta name="keywords" content="<?php echo META_KEYWORDS; ?>" />

	<?php /* Mobile viewport optimized: j.mp/bplateviewport */ ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php /* CSS: implied media="all" */ ?>
	<link rel="stylesheet" href="/_/css/style.css?<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/_/css/style.css'); ?>">

	<?php if( $body_id != 'Login' ): ?>
	<?php /* All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects */ ?>
	<script src="/_/js/libs/modernizr-1.7.min.js"></script>
	<?php endif; ?>
</head>
