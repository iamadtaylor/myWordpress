<?php
/*
PLUGIN NAME: Home Blog Summary
PLUGIN URI: http://www.plaintxt.org/experiments/blog-summary/
DESCRIPTION: Insert a list of latest blog posts using the shortcode <code>[home-blog-summary count=&quot;N&quot;]</code> (default is 5) in a semantic hAtom-enabled list. A plaintxt.org experiment for WordPress.
AUTHOR: Adapted by Ad Taylor from code b Scott Allan Wallick
AUTHOR URI: http://scottwallick.com/
VERSION: 0.1.2 &beta;
*/


// Function for our shortcode [home_blog-summary]. See readme.txt for details on attributes
function home_blog_summary_shortcode() {
	// Describes what attributes to parse from shortcode; only 'count'
			$count       =  2;;
			$grouptag    =  'ul';
			$entrytag    =  'li';
			$titletag    =  'h3';
			$datetag     =  'span';
			$summarytag  =  'p';

		
	// 	Stop loop
		
	// 	Add portfolio
	$groupclasses = 'hfeed';
	$output = '
						<ul id="features" class="'.$groupclasses.'">
							<li class="portfolio hentry">
						            <img src="http://www.iamadtaylor.com/wp-content/uploads/2009/06/bulb-300x200.jpg" alt="bulb" class="picture three" />
									<h3 class="entry-title"><a href="http://www.iamadtaylor.com/portfolio" title="View the design portfolio of Ad Taylor" rel="bookmark">design portfolio</a></h3>
									<p class="entry-summary"><a href="http://www.iamadtaylor.com/portfolio" title="View the design portfolio of Ad Taylor" rel="bookmark">Whether you want to hire me or are just wanting to procrastinate for a bit, take a look at my design portfolio. </a></p>
							</li>
		
		';
		
	// Queries to populate our loop based on shortcode count attribute
	$r = new WP_Query("showposts=$count&what_to_show=posts&nopaging=0&post_status=publish");
	// Only run if we have posts; can't run this through searches
	if ( $r->have_posts() && !is_search() ) :
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
				$entryclasses = 'article hentry';
			}
			// Begin entry wrapper and inserts what classes we got from above
			$output .= "\n\t\t\t\t\t\t" . '<' . $entrytag . ' class="' . $entryclasses . '">';
			// Add Comment bubble
			$output .= "\n\t\t\t\t\t\t\t" .'<span class="spch-bub comments"><a class="spch-bub-inside" href="#"><span class="point"></span><em>'.get_comments_number().'</em></a></span>';
			// Post title
			$output .= "\n\t\t\t\t\t\t\t" . '<' . $titletag . ' class="entry-title"><a href="' .  get_permalink() . '" title="' . sprintf( __( 'Permalink to %s', 'blog_summary' ), the_title_attribute('echo=0') ) . '" rel="bookmark">' . get_the_title() . '</a></' . $titletag . '>';
			// Post date with hAtom support
			$output .= '<span class="entry-date published"><span class="value-title" title="' . get_the_time('Y-m-d') . '"></span><span class="value-title" title="'.get_the_time('H:i:s').'"></span></span>';
			// Post excerpt with hAtom support
			$output .= "\n\t\t\t\t\t\t\t" . '<' . $summarytag . ' class="entry-summary"><a href="' .  get_permalink() . '" title="' . sprintf( __( 'Permalink to %s', 'blog_summary' ), the_title_attribute('echo=0') ) . '" rel="bookmark">' .apply_filters( 'the_excerpt', get_the_excerpt() ) . '</a></' . $summarytag . '>';
			// Close each post LI
			$output .= "\n\t\t\t\t\t\t" . '</' . $entrytag . '>';
		// Finish the have_posts() query
		endwhile; // while ( $r->have_posts() ) :
		// Close the parent UL
		$output .= "\n\t\t\t\t" . '</ul>';
		// Rewinds loop from $r->the_post();
		rewind_posts();
	// End the initial IF statement
	endif; // if ( $r->have_posts() ) :
	// Clears our query to put the loop back where it was
	wp_reset_query(); // $r = new WP_Query()http://www.iamadtaylor.com/#
	// Returns $output to the shortcode
	return $output;
}
// Allows localization. Send your translations to s AT plaintxt DOT org
load_theme_textdomain('home_blog_summary');
// Register the shortcode to the function blog_excerpts_shortcode()
add_shortcode( 'home_blog-summary', 'home_blog_summary_shortcode' );
?>