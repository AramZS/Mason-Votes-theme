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
  
  if ( $header_cats !== "" ){
  

	
	foreach ($headerCatArray as $key => $value) {
  

  
	?>
		<a href="<?php echo get_category_link( $headerCatArray[$key] ); ?>"><div class="header-category-display">
			<img src="<?php echo $imgUrlsArray[$key]; ?>" />
			<h5><?php echo get_cat_name($value); ?></h5>
			<h6><?php echo $catSubArray[$key]; ?></h6>
		</div></a>
	<?php
	
		$k++;
	
	}
  
  }  
  
?>