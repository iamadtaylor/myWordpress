<?php get_header(); ?>

			<div id="wrap">
				<?php include (TEMPLATEPATH . '/headNav.php'); ?>
				
				<div class="post clearfix">
					
					<?php include (TEMPLATEPATH . '/pageData.php'); ?>

						<div class="post" id="post-<?php the_ID(); ?>">
						 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						  <h2><a href="<?php echo get_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						  <?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>



						 <?php endwhile; else: ?>
						  <p><strong>There has been a glitch in the Matrix.</strong><br />
						  There is nothing to see here.</p>
						  <p>Please try somewhere else.</p>
						 <?php endif; ?>
						</div><!-- end #post -->
						
					
				</div>

				<div id="push" >&nbsp;</div>
			</div>


		


<?php get_footer(); ?>