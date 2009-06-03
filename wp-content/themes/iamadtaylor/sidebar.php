<div id="rightFooter">
	<div id="contact">
		<ul>
			<li><a href="mailto:hi@iamadtaylor.com" title="Email address" class="email pref">hi@iamadtaylor.com</a></li>
			<li class="tel" lang="en-gb">
				<span class="type">
				    <span class="value-title" title="cell"> </span>
				      mobile :
				    </span>
				<span class="value">07595 300 841</span>
			</li>
			<li><a title="Contact me throught Jabber" href="xmpp://ad@iamadtaylor.com" class="url im pref" rel="me">Contact me through Jabber</a></li>
		</ul>
	</div>
	
	<!-- <div id="search">
		<h2>Search</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	    
	</div> -->
	<div id="socialHub" class="clearfix">
		<h2>Social Hub</h2>
		<ul>
			<li><a href="https://twitter.com/iamadtaylor" rel="me" title="Ad Taylors twitter page"><img src="<?php echo(get_bloginfo('template_directory')); ?>/images/hicons/twitter_32.png" width="32" height="32" alt="Twitter 32"/><span class="socialText">Twitter</span></a></li>
			<li><a href="http://www.vimeo.com/adtaylor" rel="me" title="Ad Taylors vimeo page"><img src="<?php echo(get_bloginfo('template_directory')); ?>/images/hicons/vimeo_32.png" width="32" height="32" alt="Vimeo 32"/><span class="socialText">Vimeo</span></a></li>
			<li><a href="http://www.flickr.com/photos/adhoc01/" rel="me" title="Ad Taylors Flickr page"><img src="<?php echo(get_bloginfo('template_directory')); ?>/images/hicons/flickr_32.png" width="32" height="32" alt="Flickr 32"/><span class="socialText">Flickr</span></a></li>
			<li><a href="http://delicious.com/iamadtaylor" rel="me" title="Ad Taylors Delicious page"><img src="<?php echo(get_bloginfo('template_directory')); ?>/images/hicons/delicious_32x32.png" width="32" height="32" alt="Delicious 32x32"/><span class="socialText">Delicious</span></a></li>
			<li><a href="http://www.last.fm/user/iamadtaylor" rel="me" title="Ad Taylors Last.fm page"><img src="<?php echo(get_bloginfo('template_directory')); ?>/images/hicons/lastfm_32.png" width="32" height="32" alt="Lastfm 32"/><span class="socialText">Last.fm</span></a></li>
		</ul>
	</div>
	<div id="flickr">
		<h2>Flickr</h2>
		<?php
		if(function_exists('displayRandomFlickrPhotos'))
		{
		displayRandomFlickrPhotos();
		}
		
		?>
	</div>

</div>


