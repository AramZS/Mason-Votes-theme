<?php

    // calling the header.php
    get_header();

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
    	<div id="logobox">aaaaaaaaa</div>
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