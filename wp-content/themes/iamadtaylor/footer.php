		<div id="footer" class="clearfix vcard">
			<div id="leftFooter">
				
				
				<?php if(is_single()) {?>
				
					<div id="tags">
						<h3>tags</h3>
						
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php the_tags('<ul><li>','</li><li>','</li></ul>');?>
					</div>

					<div id="comments">
						

						<?php comments_template(); ?>

						 <?php endwhile; else: ?>
						 <?php endif; ?>
					</div>
				
				
				<?php } else {?>
				
				<!--
					PAGES AND CATEGORIES
				-->
				<div id="about">
					<h2>About me</h2>
					<p><strong class="fn n"><span class="given-name nickname" rel="me">Ad</span> <span class="family-name">Taylor</span></strong> is a <span class="role" >freelance web designer</span> from <span class="adr"><span class="locality">Birmingham</span>,<span class="country-name"><span class="value-title" title="United Kingdom"> UK</span></span></span>. I have just completed a degree in Multimedia Computing from Coventry University. I am besotted with design of all shapes and sizes (though I have a particular soft spot for typographical design), nothing makes me happier than sitting down and working through a design problem — even though it seems to be turning me translucent.</p>
				</div>

				<div id="recentPosts">
					<h2>Recent Posts</h2>
					<!-- <ul> -->
						
				
						<?php 
						$recentVars = array(
								'count'       =>  '4',
								'grouptag'    =>  'ul',
								'entrytag'    =>  'li',
								'titletag'    =>  'h3',
								'datetag'     =>  'span',
								'summarytag'  =>  'div',
							);
						
						
						echo blog_summary_shortcode($recentVars);?>
					

				</div>
				<?php }?>
				
			</div>
			<?php get_sidebar(); ?>
			
			


		</div>
		<script type="text/javascript">Cufon.now();</script>

		<?php wp_footer(); ?>
	</body>
</html>