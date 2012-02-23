
<div id="preview">
<?php 

  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }

	//I will want to place a value in this variable inside this function and then retrieve it elsewhere. 
  global $firstslide;
  global $poppost;
  
	//Sliders are for home page only boyo. 
	if (is_home() ):
	//Just declaring an empty variable, prob do not need to do this. 
	$firstslide = "";
	//So lets see. We need to take the comma seperated list of category IDs and manipulate them into seperate loops for each category. 
	
	$exploded_slider_cats = explode(",", $slider_cat);
	
	//Ok, now need to count the number of categories to be checked against the counter. 
	
	$cats_item_count = count($exploded_slider_cats);
	
	
			function filter_where( $where = '' ) {
			// posts in the last 1 to 90 days
			$where .= " AND post_date < '" . date('Y-m-d', strtotime('-2 days')) . "'";
			return $where;
			}
	
	
		
		//Note the meta key here. This should only select stories with featured images, eliminating the need for if checks. 
		add_filter( 'posts_where', 'filter_where' );
		$sliderquery = new WP_Query( array( 'cat' => $slider_cat, 'showposts' => 1) );
		remove_filter( 'posts_where', 'filter_where' );
		while ( $sliderquery->have_posts() ) : $sliderquery->the_post();
		
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'main-thumb' );
		$thumburl = $thumb['0']; 
	
?>
			
          <div id="mainphoto" style="background:url('<?php echo $thumburl ?>') top left no-repeat;" OnClick="javascript: location.replace('<?php the_permalink(); ?>')">
			
				
					<div><h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" ><?php the_title(); ?></a></h2></div>
				
		  </div>
			<?php 
				
				$firstslide .= get_the_ID() . ",";
		endwhile;
		wp_reset_postdata();
		wp_reset_query();
	
?>
           
            <div id="preview-side">
                <div id="preview-photos" class="mini-last">
<?php		
	
		
		$rc = 0;
		//Note the meta key here. This should only select stories with featured images, eliminating the need for if checks. 
		add_filter( 'posts_where', 'filter_where' );
		$sliderquery = new WP_Query( array( 'cat' => $slider_cat, 'showposts' => 3, 'offset' => 1 ) );
		remove_filter( 'posts_where', 'filter_where' );
		while ( $sliderquery->have_posts() ) : $sliderquery->the_post();		

		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'rnav-thumb' );
		$thumburl = $thumb['0']; 
		$rc++;
		?>

                    <div class="mini-photos<?php if ($rc == 3) { echo " mini-last";} ?>" style="background:url('<?php echo $thumburl ?>') top left no-repeat;" OnClick="javascript: location.replace('<?php the_permalink(); ?>')">
							<div class="slider-item-title<?php if ($rc == 3) { echo " mini-last";} ?>">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
							<?php
							//If title is longer than 60chars, prob not going to fit. 
							if (strlen($post->post_title) > 60) {
								echo substr(the_title($before = '', $after = '', FALSE), 0, 57) . '...'; 
							} 
							else {
								the_title();
							}
							?>
							</a>
						</div>				
					</div>                           

<?php

		$firstslide .= get_the_ID() . ",";
		endwhile;
		wp_reset_postdata();
		wp_reset_query();
		
		
?>
				</div>          
                <div id="nextevent">
				<?php if ( !function_exists ( 'dynamic_sidebar' ) || !dynamic_sidebar('Front Top Right') ) : ?>
					<div id="ftr-default" class="widget">
						<center><iframe src="https://www.google.com/calendar/b/0/embed?showTitle=0&amp;showNav=0&amp;showDate=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;mode=AGENDA&amp;height=100&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=utonbget0i2kgd29l8p3glul4o%40group.calendar.google.com&amp;color=%23A32929&amp;ctz=America%2FNew_York" style=" border-width:0 " width="258" height="130" frameborder="0" scrolling="no"></iframe></center>
					</div>
				<?php endif; ?>	
                </div>
            </div>
</div><div id="gap"></div>
		<div id="main-content">
	<?php	
	
	
		
		//Note the meta key here. This should only select stories with featured images, eliminating the need for if checks. 
		add_filter( 'posts_where', 'filter_where' );
		$sliderquery = new WP_Query( array( 'cat' => $slider_cat, 'showposts' => 1) );
		remove_filter( 'posts_where', 'filter_where' );
		while ( $sliderquery->have_posts() ) : $sliderquery->the_post();
	?>
		
        	<div id="big-story">
			
				<address class="post-meta">
					Written by <a href="<?php echo get_site_url(); ?>/author/<?php the_author_meta('user_nicename'); ?>/" rel="author" alt="<?php the_author(); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a> on <time><?php the_time( 'F j, Y' ); ?> at <?php the_time('g:i a'); ?></time>
				</address><!--/post-meta-->
				<div class="entry">
					<?php the_excerpt(); ?><p class="readmoregraf"><a href="<?php the_permalink(); ?>">Read More.</a></p><!-- Excerpt -->
					<div class="clear"></div>
				</div><!--END entry -->				
			
            </div>
	<?php
	
		endwhile;
		remove_filter('excerpt_length', 'custom_excerpt_length', 999);
		wp_reset_postdata();
		wp_reset_query();
		
		
	?>
		
<?php
	endif; //end check for home. 
	return $firstslide;
?>