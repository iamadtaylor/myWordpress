<?php get_header(); ?>
		<script src="<?php echo(get_bloginfo('template_directory')); ?>/js/onload.js" type="text/javascript"></script>
		
	</head>
	<body>
			<div id="wrap">
				<?php include (TEMPLATEPATH . '/headNav.php'); ?>
				
				<div class="article clearfix">
					<?php include (TEMPLATEPATH . '/pageData.php'); ?>
					
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
							
							<div class="entry-summary">
								<?php the_excerpt() ?>
							</div>
							<div class="entry-meta">
								<p><?php the_tags('Tags: <abbr class="tags">', ', ', '</abbr> '); ?></p>
								<p><abbr class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></abbr></p>
							</div>
							</li>
						

					 <?php endwhile; ?>
						</ul>

 
					<?php else : ?>

					 <h2>Not Found</h2>
					 <p>Try using the search form below</p>
					 <?php include (TEMPLATEPATH . '/searchform.php'); ?>

					<?php endif; ?>
				</div>

				<div id="push" >&nbsp;</div>
			</div>


		


<?php get_footer(); ?>