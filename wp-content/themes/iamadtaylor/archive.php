<?php get_header(); ?>

<?php is_tag(); ?>
 <?php if (have_posts()) : ?>

  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
  <?php /* If this is a category archive */ if (is_category()) { ?>
   <h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
   <h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
   <h2>Archive for <?php the_time('F jS, Y'); ?></h2>
  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
   <h2>Archive for <?php the_time('F, Y'); ?></h2>
  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
   <h2>Archive for <?php the_time('Y'); ?></h2>
  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
   <h2>Author Archive</h2>
  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
   <h2>Blog Archives</h2>
  <?php } ?>

 <div id="postnavigation">
  <p><?php next_posts_link('&laquo; Older Entries') ?> | <?php previous_posts_link('Newer Entries &raquo;') ?></p>
 </div> <!-- end #postnavigation -->

 <?php while (have_posts()) : the_post(); ?>
 <div class="post">
  <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
  <p><?php the_time('l, F jS, Y') ?></p>
  <?php the_content() ?>
  
  <div id="postmeta">
   <p><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><!-- | <?php trackback_rdf(); ?>--></p>
   <p>Category <?php the_category(', ') ?> | Tags: <?php the_tags('Tags: ', ', ', ', '); ?></p>
   <!-- Social Networking Links - If you're interested. Please note, that the following networking links contain invalid XHTML. -->
   <p>Social Networks : <a href="http://technorati.com/faves?add=<?php the_permalink();?>">Technorati</a>, <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>">Stumble it!</a>, <a href="http://digg.com/submit?phase=2&url= <?php the_permalink();?>&title=<?php the_title();?>">Digg</a>, <a href="http://del.icio.us/post?v=4&noui&jump=close&url=<?php the_permalink();?>&title=<?php the_title();?>">de.licio.us</a>, <a href="http://myweb.yahoo.com/myresults/bookmarklet? t=<?php the_title();?>&u=<?php the_permalink();?>&ei=UTF">Yahoo</a>, <a href="http://reddit.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" >reddit</a>, <a href="http://blogmarks.net/my/new.php? title=<?php the_title();?>&url=<?php the_permalink();?>">Blogmarks</a>, <a href="http://www.google.com/bookmarks/mark?op=edit&output=popup&bkmk=<?php the_permalink();?>&title=<?php the_title();?>">Google</a>, <a href="http://ma.gnolia.com/bookmarklet/add? url=<?php the_permalink();?>&title=<?php the_title();?>">Magnolia</a>.</p>
   <?php edit_post_link('Edit', '', ' | '); ?>
  </div><!-- end #postmeta -->

 </div><!-- end #post -->

 <?php endwhile; ?>

 <div id="postnavigation">
  <p><?php next_posts_link('&laquo; Older Entries') ?> | <?php previous_posts_link('Newer Entries &raquo;') ?></p>
 </div> <!-- end #postnavigation -->
 
<?php else : ?>

 <h2>Not Found</h2>
 <p>Try using the search form below</p>
 <?php include (TEMPLATEPATH . '/searchform.php'); ?>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>