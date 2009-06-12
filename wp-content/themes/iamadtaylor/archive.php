<?php
$tags = $_GET['tags'];
?>
<?php get_header(); ?>
			<div id="wrap">
				<?php include (TEMPLATEPATH . '/headNav.php'); ?>
				
				<div class="<?php wp_title(' '); ?> clearfix">
					<?php include (TEMPLATEPATH . '/pageData.php'); ?>

					
				
					<h2 class="tag contents">Contents</h2>

					
					<?php if (!$tags) : ?>
						 <?php if (have_posts()) : ?>					
							<ul class="hfeed">
						 <?php while (have_posts()) : the_post(); ?>
						
								<li class="hentry">
								<h2 id="post-<?php the_ID(); ?>" class="entry-title"><a href="<?php the_permalink() ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								<span class="entry-date">
									<span class="published">
										<span class="value-title" title="<?php the_time('Y-m-d') ?>"><?php the_time('l, jS F, Y') ?></span><span class="value-title" title="<?php get_the_time('H:i:s');?>'"></span>
									</span>
								</span>
							
								<p class="entry-summary">
									<span>
									<?php the_excerpt() ?>
									</span>
								</p>

								</li>
						
							
						 <?php endwhile; ?>
							</ul>
							<h2 class="tag">by tag</h2>
						 		<?php 
									echo categoryTaggerList();
								?>
							<h2 class="tag">by date</h2>
							<?php $dates =  dateArchives();
							 	echo $dates;?>
						<?php else : ?>

						 <h2>Not Found</h2>
						 <p>Try using the search form below</p>
						 <?php include (TEMPLATEPATH . '/searchform.php'); ?>

						<?php endif; ?>
					<?php else : ?>
						<?php 
						echo categoryTaggerList();
						
						
						?>
						
							 
					<?php endif; ?>
				</div>

				<div id="push" >&nbsp;</div>
			</div>


		


<?php get_footer(); ?>