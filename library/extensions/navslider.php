
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
	//Loop categories in use. 
	foreach ($exploded_slider_cats as $value) {
		
		//Note the meta key here. This should only select stories with featured images, eliminating the need for if checks. 
		add_filter( 'posts_where', 'filter_where' );
		$sliderquery = new WP_Query( array( 'cat' => $value, 'showposts' => 1) );
		remove_filter( 'posts_where', 'filter_where' );
		while ( $sliderquery->have_posts() ) : $sliderquery->the_post();
	
?>
			
           <div id="mainphoto">
				<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail( 'main-thumb' ); ?></a>
						<?php } else { ?>
							<a href="<?php the_permalink(); ?>"><img class="attachment-slide-thumb" src="<?php bloginfo('template_directory'); ?>/library/imgs/sliderdummy.png" alt="" /></a>
						<?php }	?>
			</div>
			<?php 
				
				$firstslide .= get_the_ID() . ",";
		endwhile;
		wp_reset_postdata();
		wp_reset_query();
	}
?>
           
            <div id="preview-side">
                <div id="preview-photos">
<?php		
	//Loop categories in use. 
		foreach ($exploded_slider_cats as $value) {
		
		//Note the meta key here. This should only select stories with featured images, eliminating the need for if checks. 
		add_filter( 'posts_where', 'filter_where' );
		$sliderquery = new WP_Query( array( 'cat' => $value, 'showposts' => 3, 'offset' => 1 ) );
		remove_filter( 'posts_where', 'filter_where' );
		while ( $sliderquery->have_posts() ) : $sliderquery->the_post();		
?>

                    <div class="mini-photos">
					<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail( 'rnav-thumb' ); ?></a>
						<?php } else { ?>
							<a href="<?php the_permalink(); ?>"><img class="attachment-slide-thumb" src="<?php bloginfo('template_directory'); ?>/library/imgs/sliderdummy.png" alt="" />
						<?php }	?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>"><div class="slider-item-title">
							
							<?php
							//If title is longer than 60chars, prob not going to fit. 
							if (strlen($post->post_title) > 60) {
								echo substr(the_title($before = '', $after = '', FALSE), 0, 57) . '...'; 
							} 
							else {
								the_title();
							}
							?>
						</div></a>				
					</div>                           

<?php

		$firstslide .= get_the_ID() . ",";
		endwhile;
		wp_reset_postdata();
		wp_reset_query();
		}
		
?>
				</div>          
                <div id="nextevent">
                </div>
            </div>
</div>
		<div id="main-content">
	<?php	
	//Loop categories in use. 
	foreach ($exploded_slider_cats as $value) {
		
		//Note the meta key here. This should only select stories with featured images, eliminating the need for if checks. 
		add_filter( 'posts_where', 'filter_where' );
		$sliderquery = new WP_Query( array( 'cat' => $value, 'showposts' => 1) );
		remove_filter( 'posts_where', 'filter_where' );
		while ( $sliderquery->have_posts() ) : $sliderquery->the_post();
	?>
		
        	<div id="big-story">
			
				<address class="post-meta">
					Written by <a href="<?php echo get_site_url(); ?>/author/<?php the_author_meta('user_nicename'); ?>/" rel="author" alt="<?php the_author(); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a> on <time><?php the_time( 'F j, Y' ); ?> at <?php the_time('g:i a'); ?></time>
					<a href="<?php echo get_site_url(); ?>/author/<?php the_author_meta('user_nicename'); ?>/" rel="author" alt="<?php the_author(); ?>" title="<?php the_author(); ?>"><?php echo get_avatar( get_the_author_meta('ID'), 32 ); ?></a>
				</address><!--/post-meta-->
				<div class="entry">
					<?php the_excerpt(); ?><p class="readmoregraf"><a href="<?php the_permalink(); ?>">Read More from <?php the_title(); ?></a></p><!-- Excerpt -->
					<div class="clear"></div>
				</div><!--END entry -->				
			
            </div>
	<?php
	
		endwhile;
		wp_reset_postdata();
		wp_reset_query();
		}
		
	?>
		
<?php
	endif; //end check for home. 
	return $firstslide;
?>