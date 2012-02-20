<?php 

  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }

	//I will want to place a value in this variable inside this function and then retrieve it elsewhere. 
  global $firstslide;
  
$exploded_tab_cats = explode(",", $tab_cats);
$c = 0;

function new_custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'new_custom_excerpt_length', 999 );
  
?>

<ul id="tabs">
	<?php
	foreach ($exploded_tab_cats as $value) {
		$c++;
		$cat_name = get_cat_name($value);
	?>
		<li id="tab-content-<?php echo get_cat_name($value); ?>" <?php if ($c==1){ echo "class='active-tab'";} ?>>
			<a href="javascript:viewTab('content-<?php echo get_cat_name($value); ?>');"><?php echo get_cat_name($value); ?></a>
		</li>
	<?php } ?>
</ul>
<div id="contents-container">
	<?php
	$c=0;
	foreach ($exploded_tab_cats as $value) {
		$c++;
		
	?>
		<div id="content-<?php echo get_cat_name($value); ?>" class="content-contained" <?php if ($c>1){ echo "style='display: none;'";} ?>>
		
		<?php 
			$args = array(
			/**Here post__not_in expects an array. You'd think you could put a comma seperated
			string here and that would be fine, but you can't. Instead you have to explode the comma seperated list into an array**/
			'post__not_in' => explode(",", $firstslide),
			'posts_per_page' => 5,
			'cat' => $value
			);
			
			$tabquery = new WP_Query( $args );
			
			while ( $tabquery->have_posts() ) : $tabquery->the_post();
			?>
			
				<div class="home-tab-item">
					<div class="tab-item-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
							<?php echo the_title(); ?>
						</a>
					</div>
					<div class="home-tab-content">
						<?php the_excerpt(); ?>
						
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="Read more from <?php the_title_attribute(); ?>">Read More...</a>
					</div>
				</div>
			
			<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	<?php } ?>
</div>
	