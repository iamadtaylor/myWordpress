<?php
/*
PLUGIN NAME: Remove Formatting
PLUGIN URI: http://www.iamadtaylor.com
DESCRIPTION: Takes out wordpress formatting.
AUTHOR: Ad Taylor
AUTHOR URI: http://www.iamadtaylor.com
VERSION: 0.1 &beta;
*/

function removeFormatting() {
	// kses_remove_filters();
	remove_filter ('the_content', 'wpautop');
	remove_filter('the_excerpt', 'wpautop');
	// remove_filter ('comment_text', 'wpautop');
	// echo '<span style="width:1000px;height:1000px;background-color:red;">working</span>';
}

add_action('wp_head', 'removeFormatting');
?>