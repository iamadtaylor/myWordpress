<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/searchform.php'); ?>

 <h2>Archives by Month:</h2>
 <ul><?php wp_get_archives('type=monthly'); ?></ul>

<?php get_sidebar(); ?>
<?php get_footer(); ?>