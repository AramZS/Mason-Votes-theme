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
        </div>
        <div id="preview">
            <div id="mainphoto">
            </div>
            <div id="preview-side">
                <div id="preview-photos">
                    <div class="mini-photos"></div>
                    <div class="mini-photos"></div>
                    <div class="mini-photos"></div>                             
                </div>
            
                <div id="nextevent">
                </div>
            </div>

        </div>
        <div id="main-content">
        	<div id="big-story">
            </div>
            <div id="feed">
            </div>
        </div>
        <div id="sidebar-right">
        </div>        
    </div>
    <div id="sidebar-left-box" class="left">
    	<div id="logobox">
			<a href="<?php echo site_url(); ?>"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>px" height="<?php echo HEADER_IMAGE_HEIGHT; ?>px" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
		</div>
        <div id="sidebar-left"></div>
    </div>	
   </div>
</div><!-- #container -->

<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();

?>