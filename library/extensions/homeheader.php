<?php

  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }

	$headerCatArray = explode(",",$header_cats);
	$headerCatCount = count($headerCatArray);
	$imgUrlsArray = explode(",",$header_cat_imgs);
	$imgUrlsCount = count($imgUrlsCount); 
	$catSubArray = explode(",",$header_cat_subtitles);
	$catSubCount = count($catSubArray); 
		$k=0;
		
?>

<div id="home-button-container">
	<div id="home-button-one">
		<a href="https://www.voterinfo.sbe.virginia.gov/PublicSite/Public/FT2/PublicLookup.aspx?Link=Registration&amp;AspxAutoDetectCookieSupport=1" target="_blank" onmouseover="MM_swapImage('ltButton','','<?php echo get_stylesheet_directory_uri(); ?>/library/imgs/buttons/ltButtonDown.jpg',1)" onmouseout="MM_swapImgRestore()">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/library/imgs/buttons/ltButtonUp.jpg" alt="Voting Information" name="ltButton" width="293" height="23" border="0" id="ltButton">
		</a>
	</div>
	<div id="home-button-two">
		<a href="http://www.sbe.virginia.gov/cms/Voter_Information/Registering_to_Vote/Index.html#Persons" target="_blank" onmouseover="MM_swapImage('rtButton','','<?php echo get_stylesheet_directory_uri(); ?>/library/imgs/buttons/rtButtonDown.jpg',1)" onmouseout="MM_swapImgRestore()">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/library/imgs/buttons/rtButtonUp.jpg" alt="Register to Vote" name="rtButton" width="297" height="23" border="0" id="rtButton">
		</a>
	</div>
</div>
<div id="candidates">
<?php
  
  if ( $header_cats !== "" ){
  

	
	foreach ($headerCatArray as $key => $value) {
  

  
	?>
	<div>
		<a href="<?php echo get_category_link( $headerCatArray[$key] ); ?>">
			<div class="header-category-display" style="background:url('<?php echo $imgUrlsArray[$key]; ?>') top left no-repeat;">
					<h5><?php echo get_cat_name($value); ?></h5>
					<h6><?php echo $catSubArray[$key]; ?></h6>
			</div>
		</a>
	</div>
	<?php
	
		$k++;
	
	}
  
  }  
  
?>
</div>