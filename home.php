<?php


    // Creating the doctype
    thematic_create_doctype();
    echo " ";
    language_attributes();
    echo ">\n";
    
    // Creating the head profile
    thematic_head_profile();

    // Creating the doc title
    thematic_doctitle();
    
    // Creating the content type
    thematic_create_contenttype();
    
    // Creating the description
    thematic_show_description();
    
    // Creating the robots tags
    thematic_show_robots();
    
    // Creating the canonical URL
    thematic_canonical_url();
    
    // Loading the stylesheet
    thematic_create_stylesheet();

	if (THEMATIC_COMPATIBLE_FEEDLINKS) {    
    	// Creating the internal RSS links
    	thematic_show_rss();
    
    	// Creating the comments RSS links
    	thematic_show_commentsrss();
   	}
    
    // Creating the pingback adress
    thematic_show_pingback();
    
    // Enables comment threading
    thematic_show_commentreply();

    // Calling WordPress' header action hook
    wp_head();
    
?>

</head>

<?php 

?>

<div id="maincontainer">
   <div id="innercontainer">
    <div id="front-main">
    	<div id="above">
			<?php include('library/extensions/homeheader.php'); ?>
        </div>

			<?php include('library/extensions/navslider.php'); ?>
 

        
            <div id="feed">
				<?php include('library/extensions/tabbedcontent.php'); ?>
            </div>
        </div><!-- Ending main content div from navslider -->
        <div id="sidebar-right">
			<div id="frontsocial" class="subBox">
			  <center><a href="http://feeds.feedburner.com/gmuVotes"><img src="<?php bloginfo('stylesheet_directory'); ?>/library/imgs/feedicon/orangeS.png" border="0"></a></center>
			  <div class="underBox">
				Subscribe to Mason Votes<br>
			  </div>
			  <div class="underBox2">
			  <a href="http://feeds.feedburner.com/masonvotesmain" target="_blank" class="feed">Full Feed</a><br>
			  <a href="http://feeds.feedburner.com/MasonVotesPodcasts" target="_blank" class="feed">Podcasts</a><br>
			  <a href="http://www.facebook.com/pages/Mason-Votes/36144110026" target="_blank" class="facebook">Facebook</a><br>
			  <a href="http://twitter.com/masonvotes" target="_blank" class="tweet">Twitter</a><br>
			  <a href="http://www.flickr.com/photos/masonvotes/" target="_blank" class="flickr">Flickr</a><br>
			  <a href="http://www.youtube.com/masonvotes" target="_blank" class="youtube">YouTube</a><br>
			  <a href="http://delicious.com/masonvotes" target="_blank" class="deli">Delicious</a><br>
			  </div>      
			</div>
			<div id="inner-sidebar-right">
			<?php if ( !function_exists ( 'dynamic_sidebar' ) || !dynamic_sidebar('Front Lower Right') ) : ?>
				<div id="flr-default" class="widget">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/library/imgs/ads/demProj2.jpg" />
				</div>
			<?php endif; ?>	
			</div>
        </div>        
    </div>
    <div id="sidebar-left-box" class="left">
    	<div id="logobox">
			<a href="<?php echo site_url(); ?>"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>px" height="<?php echo HEADER_IMAGE_HEIGHT; ?>px" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
		</div>
        <div id="sidebar-left">
			<div id="left-top-widgets">
				<?php if ( !function_exists ( 'dynamic_sidebar' ) || !dynamic_sidebar('Front Upper Left') ) : ?>
					<div id="ltw-default" class="widget">
						<h5>Latest News</h5>
						<div align="left">http://news.google.com/news?pz=1&cf=all&ned=us&hl=en&topic=el&output=rss</div>
					</div>
				<?php endif; ?>	
			</div>
			<div id="left-lower-widgets">
				<?php if ( !function_exists ( 'dynamic_sidebar' ) || !dynamic_sidebar('Front Lower Left') ) : ?>
				<div id="llw-default" class="widget">	http://pipes.yahoo.com/pipes/pipe.run?_id=39cac58d5600b837f732a896da8fc9a9&_render=rss
				<center><a href="http://studentmedia.gmu.edu" target="_blank"><img src="http://masonvotes.masonstudentmedia.com/images/Student-Media-Logo-S.gif" /></a></center>
				</div>
				<?php endif; ?>	
			</div>
		</div>
    </div>	
   </div>
</div><!-- #container -->

<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();
    
    // calling footer.php
    get_footer();

?>