<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
 <?php the_content(__('Read more'));?>	
<?php endwhile; else: ?>
 <h2>No Results</h2>
 <p>Please feel free try again!<p/>
 <p><?php get_searchform(); ?></p>
<?php endif; ?>

<div id="postnavigation">
 <p><?php next_posts_link('&laquo; Older Entries') ?> | <?php previous_posts_link('Newer Entries &raquo;') ?></p>
</div><!-- end #postnavigation -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>