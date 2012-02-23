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

//adding tabs functionality for the front page.

function load_prototype_script() {

	echo '<script type="text/javascript" src="' . get_bloginfo('stylesheet_directory') . '/library/extensions/prototype.js"></script>';

}

add_action('wp_head', 'load_prototype_script');

function add_tabs() {
	if (is_home()){
		?>
		<script>
			//function to view tab. From Smashing WordPress book pg260.
			function viewTab(tabId) {
			
				//get all child elements of "contents-container"
				var elements = $('contents-container').childElements();
				//Loop through them all
				for (var i=0, end=elements.length; i<end; i++) {
					//is clicked tab
					if (tabId == elements[i].id) {
						//-show element
						elements[i].show();
						// - Make sure css is correct for tab
						$('tab-'+ elements[i].id).addClassName('active-tab');
					}
					//is not the clicked tab
					else {
						// -Hide
						elements[i].hide();
						// - Make sure css is correct for tab
						$('tab-'+ elements[i].id).removeClassName('active-tab');
					}
				}
			
			}
		</script>
		
		<?php

	}
}

add_action('wp_head', 'add_tabs');

function add_buttons() {

	if (is_home()) {

	?>
	
		<script type="text/javascript">
		<!--
		function MM_swapImgRestore() { //v3.0
		  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
		}
		function MM_preloadImages() { //v3.0
		  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
			var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
			if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
		}

		function MM_findObj(n, d) { //v4.01
		  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
			d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
		  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
		  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
		  if(!x && d.getElementById) x=d.getElementById(n); return x;
		}

		function MM_swapImage() { //v3.0
		  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
		   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
		}
		//-->
		</script>
	
	<?php
	
	}
	
}

add_action('wp_head', 'add_buttons');

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
		'id' => 'front-lower-left',
		'description' => __( 'The lower left widget for the front page. ', 'thematic' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );	
	
	if ( function_exists('register_sidebar') )
	register_sidebar( array(
		'name' => __( 'Front Top Right', 'thematic' ),
		'id' => 'front-top-right',
		'description' => __( 'The widget in the middle of the right side of the front page. Do not use title. 256x100', 'thematic' ),
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

function custom_excerpt_length( $length ) {
	return 70;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

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
	    	<div id="main-logo"><a href="<?php echo site_url(); ?>"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>px" height="<?php echo HEADER_IMAGE_HEIGHT; ?>px" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a></div>
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
	


//You know what's dumb? Using PHPThumb when WordPress has a really good function that does the same thing built in. 
	
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 200, 200 ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'head-thumb', 80, 50, true ); //(hard cropped)
	add_image_size( 'main-thumb', 419, 226, true ); //(hard cropped)
	add_image_size( 'rnav-thumb', 88, 120, true ); //(hard cropped)
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