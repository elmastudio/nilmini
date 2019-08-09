<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Nilmini
 * @since Nilmini 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	$options = get_option('nilmini_theme_options');
	if( $options['custom_favicon'] != '' ) : ?>
<link rel="shortcut icon" type="image/ico" href="<?php echo $options['custom_favicon']; ?>" />

<?php endif  ?>
<!-- enable HTML5 elements in IE7+8 -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="clearfix">
	<header id="header">

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="top-border">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- end top-border -->
		<?php endif; ?>

		<div id="branding">
			<hgroup id="site-title">
				<?php
					$options = get_option('nilmini_theme_options');
					if( $options['custom_logo'] != '' ) : ?>
					<a href="<?php echo home_url( '/' ); ?>" class="logo"><img src="<?php echo $options['custom_logo']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
				<?php else: ?>
					<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif  ?>
			</hgroup><!-- end site-title -->

			<?php // Display a search form in header
			$options = get_option('nilmini_theme_options');
			if( $options['header_search'] == 0 ) : ?>
				<?php get_search_form(); ?>
			<?php endif; ?>
		</div><!-- end branding -->

			<nav id="main-nav" class="clearfix">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- end main-nav -->


			<?php if ( get_header_image() ) : ?>

			<?php
				// Check if this is a post or page, if it has a thumbnail, and if it's a big one
				if ( is_singular('page') &&
						has_post_thumbnail( $post->ID ) &&
						( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_WIDTH ) ) ) &&
						$image[1] >= HEADER_IMAGE_WIDTH ) :
						// if there is a featured image, show it
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					else : ?>
				<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" class="header-image" /><!-- end header-image -->
			<?php endif; // end check for featured image ?>

			<?php endif; // end check for header image ?>

			<?php
			$options = get_option('nilmini_theme_options');
			if( $options['custom_headerslogan'] != '' ) : ?>
			<div id="header-slogan"><p><?php echo $options['custom_headerslogan']; ?></p></div><!-- end header-slogan -->
			<?php endif  ?>

	</header><!-- end header -->
