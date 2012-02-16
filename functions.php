<?php

// include theme options (250) not working yet. 
include('library/control/options/options.php');

  // load the custom options
  global $childoptions;
  foreach ($childoptions as $value) {
    $$value['id'] = get_option($value['id'], $value['std']);
  }
  
function differ_css() {
	if (is_home()){
	
		echo '<link href="' . get_stylesheet_directory_uri() . '/home.css" rel="stylesheet" type="text/css">';
	
	}
}

add_action('wp_head', 'differ_css');

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-formats', array( 'aside', 'link', 'quote' ) );
}

//Altering the doctype to support FBML and OpenGraph
function childtheme_create_doctype($content) {
    $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n";
    $content .= '<html xmlns="http://www.w3.org/1999/xhtml"';
	$content .= 'xmlns:og="http://ogp.me/ns#"';
	$content .= 'xmlns:fb="https://www.facebook.com/2008/fbml"';
	return $content;
}
add_filter('thematic_create_doctype', 'childtheme_create_doctype');

//Should prob add some other sizes for mobile devices. 

function make_favicon() {
	echo '<link rel="shortcut icon" href="' . get_bloginfo('stylesheet_directory') . '/library/imgs/favicon.ico" />';
}

add_action('wp_head', 'make_favicon');
	
//Let's add some nice smooth opengraph functionality here to make sharing content on Facebook easier. 

include('library/extensions/opengraph-extensions.php');

function mv_widgets_init() {

	if ( function_exists('register_sidebar') )
	register_sidebar( array(
		'name' => __( 'Front Upper Left', 'thematic' ),
		'id' => 'front-up-left',
		'description' => __( 'The front upper left sidebar', 'thematic' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	) );	
	
	if ( function_exists('register_sidebar') )
	register_sidebar( array(
		'name' => __( 'Front Lower Left', 'thematic' ),
		'id' => 'front-low-left',
		'description' => __( 'The lower left widget for the front page.', 'thematic' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );	
	
	if ( function_exists('register_sidebar') )
	register_sidebar( array(
		'name' => __( 'Front Top Right', 'thematic' ),
		'id' => 'front-low-left',
		'description' => __( 'The widget in the middle of the right side of the front page. Do not use title. 260x100', 'thematic' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );		
	
	if ( function_exists('register_sidebar') )
	register_sidebar( array(
		'name' => __( 'Front Lower Right', 'thematic' ),
		'id' => 'front-low-right',
		'description' => __( 'The lower right hand widget for the front page. Do not use title. 120x300', 'thematic' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );		
}

add_action( 'widgets_init', 'mv_widgets_init' );

//enable the slideshow slider cycler for featured area. 

function mv_cycler_script() {


	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>';
	echo '<script type="text/javascript" src="' . get_bloginfo('stylesheet_directory') . '/library/extensions/jquery.cycle.all.js"></script>';
	?>
	<script type="text/javascript">
			
				$('#featured').cycle({
					fx: 'fade',
					delay: 2000,
					timeout: 7000,
					autostop: false,
					pause: true
					
				});
			
	</script>
	
<?php
}

add_action('wp_head', 'mv_cycler_script');

//custom header code
include('library/control/controlheader.php');

//creating a very different home page.
	
	function childtheme_override_brandingopen() {
	
		if ( is_home() ){
		
		}
		else{
		//Add bclass so I can change the width of the site at will. 

		echo "<div id=\"branding\" class=\"bclass\">\n";
		}
	
	}
	
	add_action('thematic_header','childtheme_override_brandingopen',1);
	
	function childtheme_override_blogtitle() {
	
		if ( is_home() ) {
		
		} else {
		?>
	    	<div id="blog-title"><span><a href="<?php bloginfo('url') ?>/" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name') ?></a></span></div>
		<?php
		}
	
	}
	
	add_action('thematic_header','childtheme_override_blogtitle',3);
	
	function childtheme_override_blogdescription(){
	
		if ( is_home() ) {
		
		} else {
			$blogdesc = '"blog-description">' . get_bloginfo('description');
	        	echo "\t\t<div id=$blogdesc</div>\n\n";
		}
	
	}
	
	add_action('thematic_header','childtheme_override_blogdescription',5);

	function childtheme_override_brandingclose(){
	
		if ( is_home() ){
		
		} else {
		
			echo "\t\t</div><!--  #branding -->\n";
		
		}
	
	}
	
	add_action('thematic_header','childtheme_override_brandingclose',7);
	
	function childtheme_override_access(){
	
		if ( is_home() ){
		
		} else {

			?>
			
			<div id="access">
					
				<div class="skip-link"><a href="#content" title="<?php _e('Skip navigation to the content', 'thematic'); ?>"><?php _e('Skip to content', 'thematic'); ?></a></div><!-- .skip-link -->
					
				<?php 
					
				if ((function_exists("has_nav_menu")) && (has_nav_menu(apply_filters('thematic_primary_menu_id', 'primary-menu')))) {
					echo  wp_nav_menu(thematic_nav_menu_args());
				} else {
					echo  thematic_add_menuclass(wp_page_menu(thematic_page_menu_args()));	
				}
				
			?>
	        
			</div><!-- #access -->
		
			<?php
		}
		
	}
	
	add_action('thematic_header','childtheme_override_access',9);

//You know what's dumb? Using PHPThumb when WordPress has a really good function that does the same thing built in. 
	
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 200, 200 ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'head-thumb', 80, 50, true ); //(hard cropped)
	add_image_size( 'main-thumb', 412, 226, true ); //(hard cropped)
	add_image_size( 'rnav-thumb', 64, 90, true ); //(hard cropped)
}

//Let's get fun places in there. We'll figure out how to fill them in a bit. 
	
/**function childtheme_override_blogtitle() { ?>

				<div id="majorstory" class="headad">
					<?php include('library/control/headstory-extension.php'); ?>
				</div>
				<div id="socialhead">
					<?php include('library/control/socialicons-extension.php'); ?>
				</div>
				<div id="searchhead">
					<?php include ( TEMPLATEPATH . '/searchform.php'); ?>
				</div>
				<div id="adrighthead" class="headad">
					<?php if ( !function_exists('dynamic_sidebar')
					|| !dynamic_sidebar('Ad Head Right') ) : ?>
						<img src="<?php bloginfo('stylesheet_directory'); ?>/library/imgs/180x150TestAd.png" />
					<?php endif; ?>
				</div>
				<div id="sitetitle">
					<div id="logo">
						<a href="<?php echo site_url(); ?>"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
					</div>
					

<?php 
	
	

}add_action('thematic_header','thematic_blogtitle',3);**/


//include('library/control/navslider.php');


/** Seriously... I hate having to rewrite numbers in CSS over and over again for body width. Let's just freaking give the width a class and add it to whatever the hell needs it, starting with the main div. **/

function altermainclass() {
?>
	<script type="text/javascript" language="javascript">
		/*<![CDATA[*/
			jQuery(document).ready( function()
			{
				jQuery('#main').addClass('bclass');
			});
		/*]]>*/
	</script>
<?php
}
add_action( 'wp_head', 'altermainclass' );

/**Who knows when the menu div may be used again, best to be specific in selections. This is just easier... honest.**/

function altermenuclass() {
?>
	<script type="text/javascript" language="javascript">
		/*<![CDATA[*/
			jQuery(document).ready( function()
			{
				jQuery('#header nav .menu').addClass('bclass');
			});
		/*]]>*/
	</script>
<?php
}
add_action( 'wp_head', 'altermenuclass' );
	
//Adds some nifty social networks to your userprofile so I can call the shit out of them.
function my_new_contactmethods( $contactmethods ) {
    // Add Twitter
    $contactmethods['twitter'] = 'Twitter name without the "@"';
    //add Facebook
    $contactmethods['facebookURL'] = 'Facebook profile URL'; 
	//Add Google Plus. 
	$contactmethods['gplusURL'] = 'Google Profile URL for authorid. Should look like https://plus.google.com/108109243710611392513/posts'; 
    return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);

//Let's change some excerpt char numbers and keep styling in!
//This does not apply if the poster uses the more tag. How to make that work?
//Answer: No idea. Droping the text I want after the excerpt tag in the loop instead. Putting just a '...' in here instead. 

function make_killer_excerpt( $text ) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace('\]\]\>', ']]&gt;', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text, '<p> <strong> <bold> <i> <em> <emphasis> <del> <h1> <h2> <h3> <h4> <h5>');
		$excerpt_length = 40; //words for some reason... would prefer a char count. Not sure how to do it. 
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
		  array_pop($words);
		  array_push($words, '...');
		  $text = implode(' ', $words);
		}
	}
return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'make_killer_excerpt');

//Action to filter asides out of RSS feed.
//Via http://wordpress.stackexchange.com/questions/18412/how-to-exclude-posts-of-a-certain-format-from-the-feed
add_action( 'pre_get_posts', 'noaside_pre_get_posts' );
function noaside_pre_get_posts( &$wp_query )
{
    if ( $wp_query->is_feed() ) {
        $post_format_tax_query = array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => 'post-format-aside', // Change this to the format you want to exclude
            'operator' => 'NOT IN'
        );
        $tax_query = $wp_query->get( 'tax_query' );
        if ( is_array( $tax_query ) ) {
            $tax_query = $tax_query + $post_format_tax_query;
        } else {
            $tax_query = array( $post_format_tax_query );
        }
        $wp_query->set( 'tax_query', $tax_query );
    }
}

?>