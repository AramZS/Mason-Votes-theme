<?php

//Stealing from 2010 to get a header image working.

	/** Tell WordPress to run mv_setup() when the 'after_setup_theme' hook is run. */
	add_action( 'after_setup_theme', 'mv_header_setup' );

	if ( ! function_exists('mv_header_setup') ):
	/**
	* @uses add_custom_image_header() To add support for a custom header.
	* @uses register_default_headers() To register the default custom header images provided with the theme.
	*
	* @since 3.0.0
	*/
	function mv_header_setup() {

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', get_stylesheet_directory_uri() . '/library/imgs/headers/websitelogo.png' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to mv_header_image_width and mv_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'mv_header_image_width', 230 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'mv_header_image_height',	230 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 620 pixels wide by 100 pixels tall (larger images will be auto-cropped to fit).
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See mv_admin_header_style(), below.
	add_custom_image_header( '', 'mv_admin_header_style' );

	// … and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array (
	'berries' => array (
	'url' => get_stylesheet_directory_uri() . '/library/imgs/headers/berries.jpg',
	'thumbnail_url' => get_stylesheet_directory_uri() . '/library/imgs/headers/berries-thumbnail.jpg',
	'description' => __( 'Berries', 'mv' )
	),
	'cherryblossom' => array (
	'url' => get_stylesheet_directory_uri() . '/library/imgs/headers/cherryblossoms.jpg',
	'thumbnail_url' => get_stylesheet_directory_uri() . '/library/imgs/headers/cherryblossoms-thumbnail.jpg',
	'description' => __( 'Cherry Blossoms', 'mv' )
	),
	'concave' => array (
	'url' => get_stylesheet_directory_uri() . '/library/imgs/headers/concave.jpg',
	'thumbnail_url' => get_stylesheet_directory_uri() . '/library/imgs/headers/concave-thumbnail.jpg',
	'description' => __( 'Concave', 'mv' )
	),
	'fern' => array (
	'url' => get_stylesheet_directory_uri() . '/library/imgs/headers/fern.jpg',
	'thumbnail_url' => get_stylesheet_directory_uri() . '/library/imgs/headers/fern-thumbnail.jpg',
	'description' => __( 'Fern', 'mv' )
	),
	'forestfloor' => array (
	'url' => get_stylesheet_directory_uri() . '/library/imgs/headers/forestfloor.jpg',
	'thumbnail_url' => get_stylesheet_directory_uri() . '/library/imgs/headers/forestfloor-thumbnail.jpg',
	'description' => __( 'Forest Floor', 'mv' )
	),
	'inkwell' => array (
	'url' => get_stylesheet_directory_uri() . '/library/imgs/headers/inkwell.jpg',
	'thumbnail_url' => get_stylesheet_directory_uri() . '/library/imgs/headers/inkwell-thumbnail.jpg',
	'description' => __( 'Inkwell', 'mv' )
	),
	'path' => array (
	'url' => get_stylesheet_directory_uri() . '/library/imgs/headers/path.jpg',
	'thumbnail_url' => get_stylesheet_directory_uri() . '/library/imgs/headers/path-thumbnail.jpg',
	'description' => __( 'Path', 'mv' )
	),
	'sunset' => array (
	'url' => get_stylesheet_directory_uri() . '/library/imgs/headers/sunset.jpg',
	'thumbnail_url' => get_stylesheet_directory_uri() . '/library/imgs/headers/sunset-thumbnail.jpg',
	'description' => __( 'Sunset', 'mv' )
	)
	) );
	}
	endif;

	if ( ! function_exists( 'mv_admin_header_style' ) ) :
	/**
	* Styles the header image displayed on the Appearance > Header admin panel.
	*
	* Referenced via add_custom_image_header() in mv_setup().
	*
	* @since 3.0.0
	*/
	function mv_admin_header_style() {
	?>
	<style type="text/css">
	#headimg {
		height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
		width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	}
	#headimg h1, #headimg #desc {
		display: none;
	}
	</style>
	<?php
	}
	endif;
?>