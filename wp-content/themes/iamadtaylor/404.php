<?php get_header(); ?>
		<script src="<?php echo(get_bloginfo('template_directory')); ?>/js/onload.js" type="text/javascript"></script>
		
	</head>
	<body>
			<div id="wrap">
				<?php include (TEMPLATEPATH . '/headNav.php'); ?>
				
				<div class="four04 clearfix">
					<?php include (TEMPLATEPATH . '/pageData.php'); ?>
					


					 <h2>Error 404 - Not Found<br />
					 <p><strong>We're very sorry, but that page doesn't exist or has been moved.</strong><br />
					 Please make sure you have the right URL.</p>
					 <p>If you still can't find what you're looking for, try using the search form below.</p>
					 <p>We're sorry for any inconvenience.</p>
 
					 <div id="searchform">
					  <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
					   <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" value="Search" onFocus="this.value=''" />
					   <input type="submit" id="searchsubmit" value="Search" />
					  </form>
					 </div><!-- end #searchform -->
 

				</div>

				<div id="push" >&nbsp;</div>
			</div>





<?php get_footer(); ?>