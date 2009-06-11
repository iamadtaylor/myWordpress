<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head profile="http://purl.org/uF/2008/03/ http://purl.org/uF/hAtom/0.1/>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		
		<title><?php wp_title(' '); ?> <?php if(wp_title(' ', false)) { echo '&raquo;'; } ?> <?php bloginfo('name'); ?></title>
		
		<meta name="author" content="Ad Taylor" />
		
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php if (!is_single()){?>
		<link rel="stylesheet" href="<?php echo(get_bloginfo('template_directory')); ?>/css/footerMain.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<?php } else {   ?>
		<link rel="stylesheet" href="<?php echo(get_bloginfo('template_directory')); ?>/css/footerComments.css" type="text/css" media="screen" title="no title" charset="utf-8" />	
		<?php }?>		
		
		<link rel="stylesheet" href="<?php echo(get_bloginfo('template_directory')); ?>/css/<?php if(is_category()) {echo single_cat_title(); } else { echo get_post_meta($post->ID, 'contentClassName', true);} ?>.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		
		<?php wp_head(); ?>	
		
		

		<script src="<?php echo(get_bloginfo('template_directory')); ?>/js/jquery.js" type="text/javascript"></script>
		<script src="<?php echo(get_bloginfo('template_directory')); ?>/js/jquery.fontavailable.min.js" type="text/javascript"></script>
		<script src="<?php echo(get_bloginfo('template_directory')); ?>/js/jquery-ui.min.js" type="text/javascript"></script>
		<?php if (get_post_meta($post->ID, 'extraJavascript', true)) {echo '<script src="'.get_bloginfo('template_directory').'/js/'.get_post_meta($post->ID, 'extraJavascript', true).'" type="text/javascript"></script>';} ?>
		<script src="<?php echo(get_bloginfo('template_directory')); ?>/js/cufon-yui.js" type="text/javascript"></script>
		<script src="<?php echo(get_bloginfo('template_directory')); ?>/js/GraublauWeb_400-GraublauWeb_700.font.js" type="text/javascript"></script>
		<script src="<?php echo(get_bloginfo('template_directory')); ?>/js/<?php echo get_post_meta($post->ID, 'javascriptOnLoad', true); ?>onload.js" type="text/javascript"></script>

	</head>
	<body>