<?php
/*
PLUGIN NAME: Blog Summary
PLUGIN URI: http://www.plaintxt.org/experiments/blog-summary/
DESCRIPTION: Insert a list of latest blog posts using the shortcode <code>[blog-summary count=&quot;N&quot;]</code> (default is 5) in a semantic hAtom-enabled list. A plaintxt.org experiment for WordPress.
AUTHOR: Scott Allan Wallick
AUTHOR URI: http://scottwallick.com/
VERSION: 0.1.2 &beta;
*/

/*
BLOG SUMMARY
by SCOTT ALLAN WALLICK, http://scottwallick.com/
from PLAINTXT.ORG, http://www.plaintxt.org/

BLOG SUMMARY is free software: you can redistribute it and/or
modify it under the terms of the GNU General Public License as
published by the Free Software Foundation, either version 3 of
the License, or (at your option) any later version.

BLOG SUMMARY is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty
of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for details.

You should have received a copy of the GNU General Public License
along with BLOG SUMMARY. If not, see www.gnu.org/licenses/.
*/

// Function for our shortcode [blog-summary]. See readme.txt for details on attributes
function blog_summary_shortcode($attr) {
	// Describes what attributes to parse from shortcode; only 'count'
	extract( shortcode_atts( array(
			// Default values for shortcode attributes
			'count'       =>  '5',
			'grouptag'    =>  'ul',
			'entrytag'    =>  'li',
			'titletag'    =>  'h4',
			'datetag'     =>  'span',
			'summarytag'  =>  'div',
		), $attr ) );
	// Queries to populate our loop based on shortcode count attribute
	$r = new WP_Query("showposts=$count&what_to_show=posts&nopaging=0&post_status=publish");
	// Only run if we have posts; can't run this through searches
	if ( $r->have_posts() && !is_search() ) :
		// If we're using a Sandbox-friendly theme . . .
		if ( function_exists('sandbox_body_class') ) {
			// We can't have double hfeed classes, otherwise it won't parse
			$groupclasses = 'xoxo';
		} else {
			// Otherwise, use hfeed to ensure hAtom compliance
			$groupclasses = 'xoxo hfeed';
		}
		// Begin the output for shortcode and inserts in the group tag what classes we have
		$output = '<' . $grouptag . ' class="' . $groupclasses . '">';
		// Begins our loop for returning posts
		while ( $r->have_posts() ) :
			// Sets which post from our loop we're at
			$r->the_post();
			// Allows the_date() with multiple posts within a single day
			unset($previousday);
			// If we're using a Sandbox-friendly theme . . .
			if ( function_exists('sandbox_post_class') ) {
				// Let's use semantic classes with each entry element
				$entryclasses = sandbox_post_class(false);
			} else {
				// Otherwise, use hentry to ensure hAtom compliance
				$entryclasses = 'hentry';
			}
			// Begin entry wrapper and inserts what classes we got from above
			$output .= "\n" . '<' . $entrytag . ' class="' . $entryclasses . '">';
			// Post title
			$output .= "\n" . '<' . $titletag . ' class="entry-title"><a href="' .  get_permalink() . '" title="' . sprintf( __( 'Permalink to %s', 'blog_summary' ), the_title_attribute('echo=0') ) . '" rel="bookmark">' . get_the_title() . '</a></' . $titletag . '>';
			// Post date with hAtom support
			$output .= "\n" . '<' . $datetag . ' class="entry-date"><span class="published"><span class="value-title" title="' . get_the_time('Y-m-d') . '">' . sprintf( __( '%s', 'blog_summary' ), the_date( '', '', '', false ) ) . '</span><span class="value-title" title="'.get_the_time('H:i:s').'"></span></span></' . $datetag . '>';
		
			// Post excerpt with hAtom support
			$output .= "\n" . '<' . $summarytag . ' class="entry-summary">' . "\n" . apply_filters( 'the_excerpt', get_the_excerpt() ) . '</' . $summarytag . '>';
			// Close each post LI
			$output .= "\n" . '</' . $entrytag . '>';
		// Finish the have_posts() query
		endwhile; // while ( $r->have_posts() ) :
		// Close the parent UL
		$output .= "\n" . '</' . $grouptag . '>';
		// Rewinds loop from $r->the_post();
		rewind_posts();
	// End the initial IF statement
	endif; // if ( $r->have_posts() ) :
	// Clears our query to put the loop back where it was
	wp_reset_query(); // $r = new WP_Query()
	// Returns $output to the shortcode
	return $output;
}
// Allows localization. Send your translations to s AT plaintxt DOT org
load_theme_textdomain('blog_summary');
// Register the shortcode to the function blog_excerpts_shortcode()
add_shortcode( 'blog-summary', 'blog_summary_shortcode' );
?>