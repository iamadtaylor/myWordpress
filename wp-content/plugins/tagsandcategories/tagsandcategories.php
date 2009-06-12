<?php
/*
PLUGIN NAME: Tags and Categories Hacks
PLUGIN URI: http://www.iamadtaylor.com
DESCRIPTION: Hacked out tags and categories.
AUTHOR: Ad Taylor
AUTHOR URI: http://www.iamadtaylor.com
VERSION: 0.1 &beta;
*/

function categoryTagger($catID = null) {
	$posts = getCategoryPosts($catID);
	$tags = getTags($posts['posts'],$posts['catID']);
	return $tags;
}

function categoryTaggerList($catID = null) {
	$posts = getCategoryPosts($catID);
	$tags = getTags($posts['posts'],$posts['catID']);
	$html = '<ul class="tags">';
	for ($i = 0; $i <= count($tags); $i++) {
		if($tags[$i]->tag) {
			$html .=  '	<li><a href="/tag/'.$tags[$i]->tag.'" rel="bookmark">'.$tags[$i]->tag.'</a></li>';
		}
	}
	$html .= '</ul>';
	return $html;
}

function getCategoryPosts($catID) {
		global $wpdb, $post;
		
		// Define variables
		if(!$catID) {
			// Get current ID
			$categories = get_the_category($post->ID);
			$catID = $categories[0]->term_id;
		}
		$taglist = '"'.$catID.'"';
		$limit = "LIMIT 100";
		$now = current_time('mysql',1);
		
		// Construct the query
		$q = "SELECT DISTINCT 
			p.ID as id FROM $wpdb->term_taxonomy t_t,
			$wpdb->term_relationships t_r, $wpdb->posts p, $wpdb->postmeta pm
			WHERE t_t.taxonomy='category' AND t_t.term_taxonomy_id = t_r.term_taxonomy_id
			AND t_r.object_id  = p.ID
			AND (t_t.term_id IN ($taglist)) AND p.post_status = 'publish'
			AND p.post_date_gmt < '$now' GROUP BY t_r.object_id
			ORDER BY id DESC, p.post_date_gmt DESC $limit";


		// Execute the query
		$related_posts = $wpdb->get_results($q);
		return array('posts' => $related_posts,'catID' => $taglist);
}


function getTags($cats,$taglist) {
	global $wpdb, $post;
	
	// Turn array into a string base list
	 $catsPosts = "'" . str_replace("'",'',str_replace('"','',urldecode($cats[0]->id))) ."'";
       $catcount = count($cats);
               if ($catcount > 1) {
               for ($i = 0; $i <= $catcount; $i++) {
                       $catsPosts = $catsPosts . ", '" . str_replace('"','',str_replace('"','',urldecode($cats[$i]->id))) . "'";
               }
               }
	// Set defaults
	$limit = "LIMIT 100";
	$now = current_time('mysql',1);
	
	// Construct the query
	$q = "SELECT DISTINCT t.slug as tag FROM $wpdb->term_taxonomy t_t,
			$wpdb->term_relationships t_r,$wpdb->terms t,$wpdb->posts p
			WHERE t_t.taxonomy='post_tag' AND (t_r.object_id IN ($catsPosts)) 
			AND t.term_id  = t_r.term_taxonomy_id AND p.post_status = 'publish'
			AND t.term_id NOT IN ($taglist) 
			ORDER BY tag DESC, p.post_date_gmt DESC $limit";
			
	// Execute the query
	$related_posts = $wpdb->get_results($q);
	// Return the values
	return $related_posts;
}

function dateArchives() { 
	global $wpdb, $post;
	$html = '	<table class="archive">';
	
	$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) 
							FROM $wpdb->posts 
							WHERE post_status = 'publish' 
							AND post_type = 'post' 
							ORDER BY post_date DESC");
							
	foreach($years as $year) { 
	$months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date) 
							FROM $wpdb->posts 
							WHERE YEAR(post_date) = $year 
							AND post_status = 'publish' 
							AND post_type = 'post' 
							ORDER BY post_date DESC");
		$html .= '
		<tr>
			<th rowspan="'.count($months).'"  scope="row"><a href="/'.$year.'" rel="bookmark">'.$year.'</a></th>';
			
		$count = 1;
	    
	          foreach($months as $month) {
					$month_text = date('M', mktime(0, 0, 0, $month, 1, $year));
					
					$posts = $wpdb->get_var("SELECT COUNT(*) 
											FROM $wpdb->posts 
											WHERE YEAR(post_date) = $year 
											AND MONTH(post_date) = $month AND post_status = 'publish' 
											AND post_type = 'post' 
											ORDER BY post_date DESC");
											
					if($count == 1) { $count = 2;} else { $html .= '<tr>';}
					
					$html .= 	'<td><a href="/'.$year.'/'.$month.'" rel="bookmark">'.$month_text.'  ( '.$posts.' )</a></td>
	 				</tr>';
	            }
		 
	}	
	$html .= '	</table>';
	return $html;
}

?>