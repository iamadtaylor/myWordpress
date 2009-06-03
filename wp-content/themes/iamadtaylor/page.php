<?php get_header(); ?>
		<script src="<?php echo(get_bloginfo('template_directory')); ?>/js/onload.js" type="text/javascript"></script>
		
	</head>
	<body>
			<div id="wrap">
<?php include (TEMPLATEPATH . '/headNav.php'); ?>
				
				<div class="<?php echo get_post_meta($post->ID, 'contentClassName', true); ?> clearfix">
						<?php include (TEMPLATEPATH . '/pageData.php');
						if (have_posts()) { 
							while (have_posts()) : the_post(); 
								the_content(__('Read more'));	
						
							endwhile;
							
							if (is_front_page()) {
								
								echo home_blog_summary_shortcode();
							}

						 }else { ?>

						  <p><strong>There has been a glitch in the Matrix.</strong><br />
						  There is nothing to see here.</p>
						  <p>Please try somewhere else.</p>
						<?php } ?>
					
				</div>

				<div id="push" >&nbsp;</div>
			</div>


		


<?php get_footer(); ?>