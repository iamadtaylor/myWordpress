<?php
/*
Template Name: Categories
*/
?>

<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/searchform.php'); ?>

 <h2>Categories</h2>
 <ul><?php wp_list_categories(); ?></ul>

 <h2>Tags</h2>
 <ul><?php the_tags(' ', ',', ''); ?></ul>

<?php get_sidebar(); ?>
<?php get_footer(); ?>