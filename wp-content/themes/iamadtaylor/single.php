<?php get_header(); ?>

<div class="post" id="post-<?php the_ID(); ?>">
 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <h2><a href="<?php echo get_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
  <?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>

  <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

  <div id="postmeta">
   <p><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><!-- | <?php trackback_rdf(); ?>--></p>
   <p>Category <?php the_category(', ') ?> | Tags: <?php the_tags(' ', ',', ' '); ?></p>
   <!-- Social Networking Links - If you're interested. Please note, that the following networking links contain invalid XHTML. -->
   <p>Social Networks : <a href="http://technorati.com/faves?add=<?php the_permalink();?>">Technorati</a>, <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>">Stumble it!</a>, <a href="http://digg.com/submit?phase=2&url= <?php the_permalink();?>&title=<?php the_title();?>">Digg</a>, <a href="http://del.icio.us/post?v=4&noui&jump=close&url=<?php the_permalink();?>&title=<?php the_title();?>">de.licio.us</a>, <a href="http://www.google.com/bookmarks/mark?op=edit&output=popup&bkmk=<?php the_permalink();?>&title=<?php the_title();?>">Google</a>, <a href="http://twitter.com/home?status=Currently reading <?php the_permalink(); ?>" title="Click to send this page to Twitter!" target="_blank">Twitter</a>, <a href="http://myweb.yahoo.com/myresults/bookmarklet? t=<?php the_title();?>&u=<?php the_permalink();?>&ei=UTF">Yahoo</a>, <a href="http://reddit.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" >reddit</a>, <a href="http://blogmarks.net/my/new.php? title=<?php the_title();?>&url=<?php the_permalink();?>">Blogmarks</a>, <a href="http://ma.gnolia.com/bookmarklet/add? url=<?php the_permalink();?>&title=<?php the_title();?>">Ma.gnolia</a>.</p>
   <p>You can follow any responses to this entry through the <?php comments_rss_link('RSS 2.0'); ?> feed.</p>
  </div><!-- end #postmeta -->

 <?php comments_template(); ?>
 <?php endwhile; else: ?>
  <p><strong>There has been a glitch in the Matrix.</strong><br />
  There is nothing to see here.</p>
  <p>Please try somewhere else.</p>
 <?php endif; ?>
</div><!-- end #post -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>