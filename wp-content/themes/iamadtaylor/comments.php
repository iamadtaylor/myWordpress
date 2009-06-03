<?php // Do not delete these lines or your computer will implode
 if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
  die ('Please do not load this page directly. Thanks!');
  if (!empty($post->post_password)) { // if there's a password
   if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie			?>

<p>
 <?php _e("This post is password protected. Enter the password to view comments."); ?>
</p>

<?php
   return;
  }
 }
 /* This variable is for alternating comment background */
 $oddcomment = 'alt';
?>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>  
<?php else : ?>

<?php if ($comments) : ?>
	<h3>Comments</h3>
	<p>If you have any feelings on this subject then please make a comment and I shall be sure to reply to you. Only rules are; don't be an arse. <br/>You can follow any responses to this entry through the <?php comments_rss_link('RSS 2.0'); ?> feed.</p>
 <ul id="commentlist">
  <?php foreach ($comments as $comment) : ?>
	
		<li id="comment-<?php comment_ID() ?>" > 
			<dl>
				<dt class="vcard"><a href="<?php comment_author_url();?>" class="fn url"><?php comment_author(); ?></a></dt>
				<dd>
					<?php echo get_avatar( $comment, 80 ); ?>
					<abbr title="<?php comment_date('Y-m-d') ?>"><?php comment_date('d/m/Y') ?></abbr>
					<blockquote>
						<?php if ($comment->comment_approved == '0') : echo "<em>Your comment is awaiting moderation.</em>"; endif; ?>
						<?php comment_text(); ?>	
					</blockquote>
				</dd>
			</dl>
		</li>
	

  <?php endforeach; /* end for each comment */ ?>
 </ul>
  
 <?php else : // this is displayed if there are no comments so far ?>
 <?php if ('open' == $post-> comment_status) : ?>
	<h3>No comments</h3>
	<p>If you have any feelings on this subject then please make a comment and I shall be sure to reply to you. Only rules are; don't be an arse. <br/>You can follow any responses to this entry through the <?php comments_rss_link('RSS 2.0'); ?> feed.</p>
 <!-- If comments are open, but there are no comments. -->
 <?php else : // comments are closed ?>
 <!-- If comments are closed. -->
 <p class="nocomments">We're sorry, but comments are closed.</p>
 <?php endif; ?>
 <?php endif; ?>
 <?php if ('open' == $post-> comment_status) : ?>
 <?php endif; // If registration required and not logged in ?>
 <?php endif; // if you delete this your computer will explode ?>


	<h3>Your comment</h3>
	
	
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<ul>
			<?php if ( $user_ID ) : ?>
			   <li>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>"> (Logout) </a> </li>
			
				<li>
					<strong>XHTML:</strong>
					You can use these tags: 
					<code><?php echo allowed_tags(); ?></code>
				</li>

				<li>
			     <textarea tabindex="4" rows="10" cols="64" id="s4" name="comment"></textarea>
			    </li>

				<li>
				     <input type="submit" value="Submit Comment" tabindex="5" id="sbutt" name="submit"/>
				     <input type="hidden" value="<?php echo $id;?>"  name="comment_post_ID"/>
				</li>

		  </ul>
		<?php  do_action('comment_form', $post->ID);?>
	</form>
			   <?php else : ?>
			
			<li>
				<label for="author" class="<?php if ($req) echo "required"; ?>" >Name </label><br/>
				<input type="text" tabindex="1" size="40" value="<?php echo $comment_author; ?>" id="s1" name="author"/>
			</li>
			
			<li>
				<label for="email" class="<?php if ($req) echo "required"; ?>">E-mail <small>(will not be published) </small></label><br/>
				<input type="text" tabindex="2" size="40"  value="<?php echo $comment_author_email; ?>" id="s2" name="email"/>
		    </li>
		
		    <li>
				<label for="url">Website</label><br/>
				<input type="text" tabindex="3" size="40"value="<?php echo $comment_author_url; ?>" id="s3" name="url"/>
		    </li>
		
	 		<li>
				<strong>XHTML:</strong>
				You can use these tags: 
				<code><?php echo allowed_tags(); ?></code>
			</li>
		    
			<li>
		     <textarea tabindex="4" rows="10" cols="64" id="s4" name="comment"></textarea>
		    </li>
		
			<li>
			     <input type="submit" value="Submit Comment" tabindex="5" id="sbutt" name="submit"/>
			     <input type="hidden" value="<?php echo $id;?>"  name="comment_post_ID"/>
			</li>
			
	  </ul>
	<?php  do_action('comment_form', $post->ID);?>
</form><?php endif; ?>