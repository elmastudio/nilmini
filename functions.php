<?php
/**
 * Nilmini functions and definitions
 *
 * @package WordPress
 * @subpackage Nilmini
 * @since Nilmini 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Set the content width based on the theme's design and stylesheet.
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 680;

/*-----------------------------------------------------------------------------------*/
/* Tell WordPress to run Nilmini() when the 'after_setup_theme' hook is run.
/*-----------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'nilmini' );

if ( ! function_exists( 'nilmini' ) ):

/*-----------------------------------------------------------------------------------*/
/* Create Nilmini Theme Options Page
/*-----------------------------------------------------------------------------------*/

require_once ( get_template_directory() . '/includes/theme-options.php' );

/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers support for WordPress features.
/*-----------------------------------------------------------------------------------*/

function nilmini() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( array( 'editor-style.css' ) );

	// Make Nilmini available for translation. Translations can be added to the /languages/ directory.
	load_theme_textdomain( 'nilmini', get_template_directory() . '/languages' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for editor font sizes.
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __( 'small', 'nilmini' ),
			'shortName' => __( 'S', 'nilmini' ),
			'size' => 15,
			'slug' => 'small'
		),
		array(
			'name' => __( 'regular', 'nilmini' ),
			'shortName' => __( 'M', 'nilmini' ),
			'size' => 17,
			'slug' => 'regular'
		),
		array(
			'name' => __( 'large', 'nilmini' ),
			'shortName' => __( 'L', 'nilmini' ),
			'size' => 21,
			'slug' => 'large'
		),
		array(
			'name' => __( 'larger', 'nilmini' ),
			'shortName' => __( 'XL', 'nilmini' ),
			'size' => 25,
			'slug' => 'larger'
		)
	) );

	// Add editor color palette.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __( 'black', 'nilmini' ),
			'slug' => 'black',
			'color' => '#000000',
		),
		array(
			'name' => __( 'white', 'nilmini' ),
			'slug' => 'white',
			'color' => '#ffffff',
		),
		array(
			'name' => __( 'light grey', 'nilmini' ),
			'slug' => 'light-grey',
			'color' => '#f0f0f0',
		),
		array(
			'name' => __( 'red', 'nilmini' ),
			'slug' => 'red',
			'color' => '#E84D38',
		),
	) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'nilmini' ),
		'footer' => __( 'Footer Navigation', 'nilmini' )
	) );

	// Add support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'status', 'link', 'quote', 'chat', 'image', 'gallery', 'video', 'audio' ) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'nilmini_custom_background_args', array(
		'default-color' => 'ffffff',
	) ) );

	// Add support for custom headers.
	$custom_header_support = array(
		'width' => apply_filters( 'nilmini_header_image_width', 898 ),
		'height' => apply_filters( 'nilmini_image_height', 290 ),
		'flex-height' => true,
		'random-default' => true,
		'header-text' => false,
		'wp-head-callback' => '',
		'admin-head-callback' => 'nilmini_admin_header_style',
		'admin-preview-callback' => 'nilmini_admin_header_image',
	);

	add_theme_support( 'custom-header', $custom_header_support );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
			'ocean' => array(
			'url' => '%s/images/headers/ocean.jpg',
			'thumbnail_url' => '%s/images/headers/ocean-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Ocean', 'nilmini' )
		),
		'flowers' => array(
			'url' => '%s/images/headers/flowers.jpg',
			'thumbnail_url' => '%s/images/headers/flowers-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Flowers', 'nilmini' )
		),
		'city' => array(
			'url' => '%s/images/headers/city.jpg',
			'thumbnail_url' => '%s/images/headers/city-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'City', 'nilmini' )
		)
	) );
}
endif;

if ( ! function_exists( 'nilmini_admin_header_style' ) ) :

/*-----------------------------------------------------------------------------------*/
/* Styles the header image displayed on the Appearance > Header admin panel.
/* Referenced via add_custom_image_header() in nilmini_setup().
/*-----------------------------------------------------------------------------------*/

function nilmini_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#heading {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif; // nilmini_admin_header_style

if ( ! function_exists( 'nilmini_admin_header_image' ) ) :

/*-----------------------------------------------------------------------------------*/
/* Custom header image markup displayed on the Appearance > Header admin panel.
/*-----------------------------------------------------------------------------------*/

function nilmini_admin_header_image() { ?>
	<div id="headimg">
		<?php
		$image = get_header_image();
		if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // nilmini_admin_header_image

/*-----------------------------------------------------------------------------------*/
/* Call Nilmini Custom.js, fitvids.js (for responsive embedded videos)
/* and Respond.js (see https://github.com/scottjehl/Respond)
/*-----------------------------------------------------------------------------------*/

add_action('wp_enqueue_scripts','nilmini_scripts_function');
	function nilmini_scripts_function() {
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', false, '1.1');
		wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', false, '1.0');
}

/*-----------------------------------------------------------------------------------*/
/* Load block editor styles.
/*-----------------------------------------------------------------------------------*/
function nilmini_block_editor_styles() {
 wp_enqueue_style( 'nilmini-block-editor-styles', get_template_directory_uri() . '/block-editor.css');
}
add_action( 'enqueue_block_editor_assets', 'nilmini_block_editor_styles' );

/*-----------------------------------------------------------------------------------*/
/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
/*-----------------------------------------------------------------------------------*/

function nilmini_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'nilmini_page_menu_args' );

/*-----------------------------------------------------------------------------------*/
/* Sets the post excerpt length to 40 characters.
/*-----------------------------------------------------------------------------------*/

function nilmini_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'nilmini_excerpt_length' );

/*-----------------------------------------------------------------------------------*/
/* Returns a "Continue Reading" link for excerpts
/*-----------------------------------------------------------------------------------*/

function nilmini_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'nilmini' ) . '</a>';
}

/*-----------------------------------------------------------------------------------*/
/* Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and nilmini_continue_reading_link().
/*
/* To override this in a child theme, remove the filter and add your own
/* function tied to the excerpt_more filter hook.
/*-----------------------------------------------------------------------------------*/

function nilmini_auto_excerpt_more( $more ) {
	return ' &hellip;' . nilmini_continue_reading_link();
}
add_filter( 'excerpt_more', 'nilmini_auto_excerpt_more' );

/*-----------------------------------------------------------------------------------*/
/* Adds a pretty "Continue Reading" link to custom post excerpts.
/*
/* To override this link in a child theme, remove the filter and add your own
/* function tied to the get_the_excerpt filter hook.
/*-----------------------------------------------------------------------------------*/

function nilmini_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= nilmini_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'nilmini_custom_excerpt_more' );

/*-----------------------------------------------------------------------------------*/
/* Remove inline styles printed when the gallery shortcode is used.
/*-----------------------------------------------------------------------------------*/

function nilmini_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'nilmini_remove_gallery_css' );

if ( ! function_exists( 'nilmini_comment' ) ) :

/*-----------------------------------------------------------------------------------*/
/* Template for comments and pingbacks
/*-----------------------------------------------------------------------------------*/

function nilmini_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<?php echo get_avatar( $comment, 40 ); ?>

			<div class="comment-header">
				<?php printf( __( '%s', 'nilmini' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>

				<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'nilmini' ),
					get_comment_date(),
					get_comment_time() );
				?></a>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'nilmini' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

				<?php edit_comment_link( __( '| Edit &rarr;', 'nilmini' ), ' ' );?>
			</div><!-- end comment-header -->

			<div class="comment-content">
				<?php comment_text(); ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'nilmini' ); ?></p>
				<?php endif; ?>
			</div><!-- end comment-content -->
		</article><!-- end comment -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'nilmini' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('| Edit &rarr;', 'nilmini'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Register widgetized area and update sidebar with default widgets
/*-----------------------------------------------------------------------------------*/

function nilmini_widgets_init() {

	register_sidebar( array (
		'name' => __( 'Header Social Links', 'nilmini' ),
		'id' => 'sidebar-1',
		'description' => __( 'An optional Social Links widget (to link to your twitter, facebook or Google+ profile) at the top of the header.', 'nilmini' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Footer Area One', 'nilmini' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional widget area for the left footer column.', 'nilmini' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Footer Area Two', 'nilmini' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for the middle footer column.', 'nilmini' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Footer Area Three', 'nilmini' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for the right footer column.', 'nilmini' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'init', 'nilmini_widgets_init' );

/*-----------------------------------------------------------------------------------*/
/* Customized Nilmini search form
/*-----------------------------------------------------------------------------------*/

function nilmini_search_form( $form ) {

		$form = '	<form method="get" id="searchform" action="'.home_url().'">
			<input type="text" class="field" name="s" id="s"  placeholder="'. esc_attr__('Search', 'nilmini') .'" />
			<input type="submit" class="submit" name="submit" id="searchsubmit" value="'. esc_attr__('Search', 'nilmini') .'" />
	</form>';

		return $form;
}
add_filter( 'get_search_form', 'nilmini_search_form' );


/*-----------------------------------------------------------------------------------*/
/* Add One Click Demo Import code.
/*-----------------------------------------------------------------------------------*/
require get_template_directory() . '/includes/demo-installer.php';


/*-----------------------------------------------------------------------------------*/
/* Nilmini Shortcodes
/*-----------------------------------------------------------------------------------*/

// Enable shortcodes in widget areas
add_filter( 'widget_text', 'do_shortcode' );

// Replace WP autop formatting
if (!function_exists( "nilmini_remove_wpautop")) {
	function nilmini_remove_wpautop($content) {
		$content = do_shortcode( shortcode_unautop( $content ) );
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
		return $content;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Multi Columns Shortcodes
/* Don't forget to add "_last" behind the shortcode if it is the last column.
/*-----------------------------------------------------------------------------------*/

// Two Columns
function nilmini_shortcode_two_columns_one( $atts, $content = null ) {
	 return '<div class="two-columns-one">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_columns_one', 'nilmini_shortcode_two_columns_one' );

function nilmini_shortcode_two_columns_one_last( $atts, $content = null ) {
	 return '<div class="two-columns-one last">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'two_columns_one_last', 'nilmini_shortcode_two_columns_one_last' );

// Three Columns
function nilmini_shortcode_three_columns_one($atts, $content = null) {
	 return '<div class="three-columns-one">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_one', 'nilmini_shortcode_three_columns_one' );

function nilmini_shortcode_three_columns_one_last($atts, $content = null) {
	 return '<div class="three-columns-one last">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_one_last', 'nilmini_shortcode_three_columns_one_last' );

function nilmini_shortcode_three_columns_two($atts, $content = null) {
	 return '<div class="three-columns-two">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_two', 'nilmini_shortcode_three_columns' );

function nilmini_shortcode_three_columns_two_last($atts, $content = null) {
	 return '<div class="three-columns-two last">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'three_columns_two_last', 'nilmini_shortcode_three_columns_two_last' );

// Four Columns
function nilmini_shortcode_four_columns_one($atts, $content = null) {
	 return '<div class="four-columns-one">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_one', 'nilmini_shortcode_four_columns_one' );

function nilmini_shortcode_four_columns_one_last($atts, $content = null) {
	 return '<div class="four-columns-one last">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_one_last', 'nilmini_shortcode_four_columns_one_last' );

function nilmini_shortcode_four_columns_two($atts, $content = null) {
	 return '<div class="four-columns-two">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_two', 'nilmini_shortcode_four_columns_two' );

function nilmini_shortcode_four_columns_two_last($atts, $content = null) {
	 return '<div class="four-columns-two last">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_two_last', 'nilmini_shortcode_four_columns_two_last' );

function nilmini_shortcode_four_columns_three($atts, $content = null) {
	 return '<div class="four-columns-three">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_three', 'nilmini_shortcode_four_columns_three' );

function nilmini_shortcode_four_columns_three_last($atts, $content = null) {
	 return '<div class="four-columns-three last">' . nilmini_remove_wpautop($content) . '</div>';
}
add_shortcode( 'four_columns_three_last', 'nilmini_shortcode_four_columns_three_last' );

// Divide Text Shortcode
function nilmini_shortcode_divider($atts, $content = null) {
	 return '<div class="divider"></div>';
}
add_shortcode( 'divider', 'nilmini_shortcode_divider' );

/*-----------------------------------------------------------------------------------*/
/* Text Highlight and Info Boxes Shortcodes
/*-----------------------------------------------------------------------------------*/

function nilmini_shortcode_white_box($atts, $content = null) {
	 return '<div class="white-box">' . do_shortcode( nilmini_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'white_box', 'nilmini_shortcode_white_box' );

function nilmini_shortcode_yellow_box($atts, $content = null) {
	 return '<div class="yellow-box">' . do_shortcode( nilmini_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'yellow_box', 'nilmini_shortcode_yellow_box' );

function nilmini_shortcode_red_box($atts, $content = null) {
	 return '<div class="red-box">' . do_shortcode( nilmini_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'red_box', 'nilmini_shortcode_red_box' );

function nilmini_shortcode_blue_box($atts, $content = null) {
	 return '<div class="blue-box">' . do_shortcode( nilmini_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'blue_box', 'nilmini_shortcode_blue_box' );

function nilmini_shortcode_green_box($atts, $content = null) {
	 return '<div class="green-box">' . do_shortcode( nilmini_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'green_box', 'nilmini_shortcode_green_box' );

function nilmini_shortcode_darkgrey_box($atts, $content = null) {
	 return '<div class="darkgrey-box">' . do_shortcode( nilmini_remove_wpautop($content) ) . '</div>';
}
add_shortcode( 'darkgrey_box', 'nilmini_shortcode_darkgrey_box' );

/*-----------------------------------------------------------------------------------*/
/* Buttons Shortcodes
/*-----------------------------------------------------------------------------------*/

function nilmini_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'link'	=> '#',
		'target'	=> '',
		'color'	=> '',
		'size'	=> '',
		'align'	=> '',
		), $atts));

	$style = ($color) ? ' '.$color. '-btncolor' : '';
	$align = ($align) ? ' align'.$align : '';
	$size = ($size == 'large') ? ' large-button' : '';
	$target = ($target == 'blank') ? ' target="_blank"' : '';

	$out = '<a' .$target. ' class="button-link' .$style.$size.$align. '" href="' .$link. '"><span>' .do_shortcode($content). '</span></a>';

		return $out;
}
add_shortcode('button', 'nilmini_button');

/*-----------------------------------------------------------------------------------*/
/* Deactives the default CSS styles for the Smart Archives Reloaded plugin
/*-----------------------------------------------------------------------------------*/

add_filter('smart_archives_load_default_styles', '__return_false');

/*-----------------------------------------------------------------------------------*/
/* Include a custom Flickr Widget
/*-----------------------------------------------------------------------------------*/

class nilmini_flickr extends WP_Widget {

	public function __construct() {
		parent::__construct( 'nilmini_flickr', __( 'Flickr Widget', 'nilmini' ), array(
			'classname'   => 'widget_nilmini_flickr',
			'description' => __( 'Show preview images from a flickr account or group', 'nilmini' ),
		) );
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$id = $instance['id'];
		$number = $instance['number'];
		$type = $instance['type'];
		$sorting = $instance['sorting'];

		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title">'.$title.'</h3>'; ?>

				<div class="flickr_badge_wrapper"><script type="text/javascript" src="https://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=<?php echo $sorting; ?>&amp;&amp;source=<?php echo $type; ?>&amp;<?php echo $type; ?>=<?php echo $id; ?>&amp;size=s"></script><div class="clear"></div></div>

		 <?php
		 echo $after_widget;
	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$title = esc_attr($instance['title']);
		$id = esc_attr($instance['id']);
		$number = esc_attr($instance['number']);
		$type = esc_attr($instance['type']);
		$sorting = esc_attr($instance['sorting']);
		?>

		 <p>
						<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
				</p>
				<p>
						<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('id'); ?>" value="<?php echo $id; ?>" class="widefat" id="<?php echo $this->get_field_id('id'); ?>" />
				</p>
				 <p>
						<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos:','nilmini'); ?></label>
						<select name="<?php echo $this->get_field_name('number'); ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>">
								<?php for ( $i = 1; $i <= 10; $i += 1) { ?>
								<option value="<?php echo $i; ?>" <?php if($number == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
								<?php } ?>
						</select>
				</p>
				<p>
						<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Choose user or group:','nilmini'); ?></label>
						<select name="<?php echo $this->get_field_name('type'); ?>" class="widefat" id="<?php echo $this->get_field_id('type'); ?>">
								<option value="user" <?php if($type == "user"){ echo "selected='selected'";} ?>><?php _e('User', 'nilmini'); ?></option>
								<option value="group" <?php if($type == "group"){ echo "selected='selected'";} ?>><?php _e('Group', 'nilmini'); ?></option>
						</select>
				</p>
				<p>
						<label for="<?php echo $this->get_field_id('sorting'); ?>"><?php _e('Show latest or random pictures:','nilmini'); ?></label>
						<select name="<?php echo $this->get_field_name('sorting'); ?>" class="widefat" id="<?php echo $this->get_field_id('sorting'); ?>">
								<option value="latest" <?php if($sorting == "latest"){ echo "selected='selected'";} ?>><?php _e('Latest', 'nilmini'); ?></option>
								<option value="random" <?php if($sorting == "random"){ echo "selected='selected'";} ?>><?php _e('Random', 'nilmini'); ?></option>
						</select>
				</p>
		<?php
	}
}

register_widget('nilmini_flickr');

/*-----------------------------------------------------------------------------------*/
/* Including a custom Social Media Widget
/*-----------------------------------------------------------------------------------*/

 class nilmini_sociallinks extends WP_Widget {

	public function __construct() {
		parent::__construct( 'nilmini_sociallinks', __( 'Social Links Widget', 'nilmini' ), array(
			'classname'   => 'widget_nilmini_sociallinks',
			'description' => __( 'Link to your social profiles.', 'nilmini' ),
		) );
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$googleplus = $instance['googleplus'];
		$flickr = $instance['flickr'];
		$picasa = $instance['picasa'];
		$fivehundredpx = $instance['fivehundredpx'];
		$delicious = $instance['delicious'];
		$youtube = $instance['youtube'];
		$vimeo = $instance['vimeo'];
		$dribbble = $instance['dribbble'];
		$ffffound = $instance['ffffound'];
		$pinterest = $instance['pinterest'];
		$zootool = $instance['zootool'];
		$behance = $instance['behance'];
		$squidoo = $instance['squidoo'];
		$slideshare = $instance['slideshare'];
		$lastfm = $instance['lastfm'];
		$grooveshark = $instance['grooveshark'];
		$soundcloud = $instance['soundcloud'];
		$foursquare = $instance['foursquare'];
		$gowalla = $instance['gowalla'];
		$linkedin = $instance['linkedin'];
		$xing = $instance['xing'];
		$wordpress = $instance['wordpress'];
		$tumblr = $instance['tumblr'];
		$rss = $instance['rss'];
		$rsscomments = $instance['rsscomments'];
		$target = $instance['target'];


		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title">'.$title.'</h3>'; ?>

				<ul class="sociallinks">
			<?php
			if($twitter != '' && $target != ''){
				echo '<li><a href="'.$twitter.'" class="twitter" title="Twitter" target="_blank">Twitter</a></li>';
			} elseif($twitter != '') {
				echo '<li><a href="'.$twitter.'" class="twitter" title="Twitter">Twitter</a></li>';
			}
			?>
			<?php
			if($facebook != '' && $target != ''){
				echo '<li><a href="'.$facebook.'" class="facebook" title="Facebook" target="_blank">Facebook</a></li>';
			} elseif($facebook != '') {
				echo '<li><a href="'.$facebook.'" class="facebook" title="Facebook">Facebook</a></li>';
			}
			?>
			<?php
			if($googleplus != '' && $target != ''){
				echo '<li><a href="'.$googleplus.'" class="googleplus" title="Google+" target="_blank">Google+</a></li>';
			} elseif($googleplus != '') {
				echo '<li><a href="'.$googleplus.'" class="googleplus" title="Google+">Google+</a></li>';
			}
			?>
			<?php if($flickr != '' && $target != ''){
				echo '<li><a href="'.$flickr.'" class="flickr" title="Flickr" target="_blank">Flickr</a></li>';
			} elseif($flickr != '') {
				echo '<li><a href="'.$flickr.'" class="flickr" title="Flickr">Flickr</a></li>';
			}
			?>

			<?php if($picasa != '' && $target != ''){
				echo '<li><a href="'.$picasa.'" class="picasa" title="Picasa" target="_blank">Picasa</a></li>';
			} elseif($picasa != '') {
				echo '<li><a href="'.$picasa.'" class="picasa" title="Picasa">Picasa</a></li>';
			}
			?>

			<?php if($fivehundredpx != '' && $target != ''){
				echo '<li><a href="'.$fivehundredpx.'" class="fivehundredpx" title="500px" target="_blank">500px</a></li>';
			} elseif($fivehundredpx != '') {
				echo '<li><a href="'.$fivehundredpx.'" class="fivehundredpx" title="500px">500px</a></li>';
			}
			?>
			<?php if($delicious != '' && $target != ''){
			echo '<li><a href="'.$delicious.'" class="delicious" title="Delicious" target="_blank">Delicious</a></li>';
			} elseif($delicious != '') {
				echo '<li><a href="'.$delicious.'" class="delicious" title="Delicious">Delicious</a></li>';
			}
			?>
			<?php if($youtube != '' && $target != ''){
			echo '<li><a href="'.$youtube.'" class="youtube" title="YouTube" target="_blank">YouTube</a></li>';
			} elseif($youtube != '') {
				echo '<li><a href="'.$youtube.'" class="youtube" title="YouTube">YouTube</a></li>';
			}
			?>
			<?php if($vimeo != '' && $target != ''){
			echo '<li><a href="'.$vimeo.'" class="vimeo" title="Vimeo" target="_blank">Vimeo</a></li>';
			} elseif($vimeo != '') {
				echo '<li><a href="'.$vimeo.'" class="vimeo" title="Vimeo">Vimeo</a></li>';
			}
			?>
			<?php if($dribbble != '' && $target != ''){
			echo '<li><a href="'.$dribbble.'" class="dribbble" title="Dribbble" target="_blank">Dribbble</a></li>';
			} elseif($dribbble != '') {
				echo '<li><a href="'.$dribbble.'" class="dribbble" title="Dribbble">Dribbble</a></li>';
			}
			?>
			<?php if($ffffound != '' && $target != ''){
			echo '<li><a href="'.$ffffound.'" class="ffffound" title="Ffffound" target="_blank">Ffffound</a></li>';
			} elseif($ffffound != '') {
				echo '<li><a href="'.$ffffound.'" class="ffffound" title="Ffffound">Ffffound</a></li>';
			}
			?>
			<?php if($pinterest != '' && $target != ''){
			echo '<li><a href="'.$pinterest.'" class="pinterest" title="Pinterest" target="_blank">Pinterest</a></li>';
			} elseif($pinterest != '') {
				echo '<li><a href="'.$pinterest.'" class="pinterest" title="Pinterest">Pinterest</a></li>';
			}
			?>
			<?php if($zootool != '' && $target != ''){
				echo '<li><a href="'.$zootool.'" class="zootool" title="Zootool" target="_blank">Zootool</a></li>';
			} elseif($zootool != '') {
				echo '<li><a href="'.$zootool.'" class="zootool" title="Zootool">Zootool</a></li>';
			}
			?>
			<?php if($behance != '' && $target != ''){
				echo '<li><a href="'.$behance.'" class="behance" title="Behance Network" target="_blank">Behance Network</a></li>';
			} elseif($behance != '') {
				echo '<li><a href="'.$behance.'" class="behance" title="Behance Network">Behance Network</a></li>';
			}
			?>
			<?php if($squidoo != '' && $target != ''){
				echo '<li><a href="'.$squidoo.'" class="squidoo" title="Squidoo" target="_blank">Squidoo</a></li>';
			} elseif($squidoo != '') {
				echo '<li><a href="'.$squidoo.'" class="squidoo" title="Squidoo">Squidoo</a></li>';
			}
			?>
			<?php if($slideshare != '' && $target != ''){
				echo '<li><a href="'.$slideshare.'" class="slideshare" title="Slideshare" target="_blank">Slideshare</a></li>';
			} elseif($slideshare != '') {
				echo '<li><a href="'.$slideshare.'" class="slideshare" title="Slideshare">Slideshare</a></li>';
			}
			?>
			<?php if($lastfm != '' && $target != ''){
				echo '<li><a href="'.$lastfm.'" class="lastfm" title="Lastfm" target="_blank">Lastfm</a></li>';
			} elseif($lastfm != '') {
				echo '<li><a href="'.$lastfm.'" class="lastfm" title="Lastfm">Lastfm</a></li>';
			}
			?>
			<?php if($grooveshark != '' && $target != ''){
				echo '<li><a href="'.$grooveshark.'" class="grooveshark" title="Grooveshark" target="_blank">Grooveshark</a></li>';
			} elseif($grooveshark != '') {
				echo '<li><a href="'.$grooveshark.'" class="grooveshark" title="Grooveshark">Grooveshark</a></li>';
			}
			?>
			<?php if($soundcloud != '' && $target != ''){
				echo '<li><a href="'.$soundcloud.'" class="soundcloud" title="Soundcloud" target="_blank">Soundcloud</a></li>';
			} elseif($soundcloud != '') {
				echo '<li><a href="'.$soundcloud.'" class="soundcloud" title="Soundcloud">Soundcloud</a></li>';
			}
			?>
			<?php if($foursquare != '' && $target != ''){
				echo '<li><a href="'.$foursquare.'" class="foursquare" title="Foursquare" target="_blank">Foursquare</a></li>';
			} elseif($foursquare != '') {
				echo '<li><a href="'.$foursquare.'" class="foursquare" title="Foursquare">Foursquare</a></li>';
			}
			?>
			<?php if($gowalla != '' && $target != ''){
				echo '<li><a href="'.$gowalla.'" class="gowalla" title="Gowalla" target="_blank">Gowalla</a></li>';
			} elseif($gowalla != '') {
				echo '<li><a href="'.$gowalla.'" class="gowalla" title="Gowalla">Gowalla</a></li>';
			}
			?>
			<?php if($linkedin != '' && $target != ''){
				echo '<li><a href="'.$linkedin.'" class="linkedin" title="LinkedIn" target="_blank">LinkedIn</a></li>';
			} elseif($linkedin != '') {
				echo '<li><a href="'.$linkedin.'" class="linkedin" title="LinkedIn">LinkedIn</a></li>';
			}
			?>
			<?php if($xing != '' && $target != ''){
				echo '<li><a href="'.$xing.'" class="xing" title="Xing" target="_blank">Xing</a></li>';
			} elseif($xing != '') {
				echo '<li><a href="'.$xing.'" class="xing" title="Xing">Xing</a></li>';
			}
			?>
			<?php if($wordpress != '' && $target != ''){
				echo '<li><a href="'.$wordpress.'" class="wordpress" title="WordPress" target="_blank">WordPress</a></li>';
			} elseif($wordpress != '') {
				echo '<li><a href="'.$wordpress.'" class="wordpress" title="WordPress">WordPress</a></li>';
			}
			?>
			<?php if($tumblr != '' && $target != ''){
				echo '<li><a href="'.$tumblr.'" class="tumblr" title="Tumblr" target="_blank">Tumblr</a></li>';
			} elseif($tumblr != '') {
				echo '<li><a href="'.$tumblr.'" class="tumblr" title="Tumblr">Tumblr</a></li>';
			}
			?>
			<?php if($rss != '' && $target != ''){
				echo '<li><a href="'.$rss.'" class="rss" title="RSS Feed" target="_blank">RSS Feed</a></li>';
			} elseif($rss != '') {
				echo '<li><a href="'.$rss.'" class="rss" title="RSS Feed">RSS Feed</a></li>';
			}
			?>
			<?php if($rsscomments != '' && $target != ''){
				echo '<li><a href="'.$rsscomments.'" class="rsscomments" title="RSS Comments" target="_blank">RSS Comments</a></li>';
			} elseif($rsscomments != '') {
				echo '<li><a href="'.$rsscomments.'" class="rsscomments" title="RSS Comments">RSS Comments</a></li>';
			}
			?>
		</ul><!-- end .sociallinks -->

		 <?php
		 echo $after_widget;
	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$title = esc_attr($instance['title']);
		$twitter = esc_attr($instance['twitter']);
		$facebook = esc_attr($instance['facebook']);
		$googleplus = esc_attr($instance['googleplus']);
		$flickr = esc_attr($instance['flickr']);
		$picasa = esc_attr($instance['picasa']);
		$fivehundredpx = esc_attr($instance['fivehundredpx']);
		$delicious = esc_attr($instance['delicious']);
		$youtube = esc_attr($instance['youtube']);
		$vimeo = esc_attr($instance['vimeo']);
		$dribbble = esc_attr($instance['dribbble']);
		$ffffound = esc_attr($instance['ffffound']);
		$pinterest = esc_attr($instance['pinterest']);
		$zootool = esc_attr($instance['zootool']);
		$behance = esc_attr($instance['behance']);
		$squidoo = esc_attr($instance['squidoo']);
		$slideshare = esc_attr($instance['slideshare']);
		$lastfm = esc_attr($instance['lastfm']);
		$grooveshark = esc_attr($instance['grooveshark']);
		$soundcloud = esc_attr($instance['soundcloud']);
		$foursquare = esc_attr($instance['foursquare']);
		$gowalla = esc_attr($instance['gowalla']);
		$linkedin = esc_attr($instance['linkedin']);
		$xing = esc_attr($instance['xing']);
		$wordpress = esc_attr($instance['wordpress']);
		$tumblr = esc_attr($instance['tumblr']);
		$rss = esc_attr($instance['rss']);
		$rsscomments = esc_attr($instance['rsscomments']);
		$target = esc_attr($instance['target']);

		?>

		 <p>
						<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $twitter; ?>" class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $facebook; ?>" class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('googleplus'); ?>"><?php _e('Google+ URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('googleplus'); ?>" value="<?php echo $googleplus; ?>" class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('flickr'); ?>" value="<?php echo $flickr; ?>" class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('picasa'); ?>"><?php _e('Picasa URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('picasa'); ?>" value="<?php echo $picasa; ?>" class="widefat" id="<?php echo $this->get_field_id('picasa'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('fivehundredpx'); ?>"><?php _e('500px URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('fivehundredpx'); ?>" value="<?php echo $fivehundredpx; ?>" class="widefat" id="<?php echo $this->get_field_id('fivehundredpx'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('delicious'); ?>"><?php _e('Delicious URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('delicious'); ?>" value="<?php echo $delicious; ?>" class="widefat" id="<?php echo $this->get_field_id('delicious'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('YouTube URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $youtube; ?>" class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('vimeo'); ?>" value="<?php echo $vimeo; ?>" class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('dribbble'); ?>"><?php _e('Dribbble URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('dribbble'); ?>" value="<?php echo $dribbble; ?>" class="widefat" id="<?php echo $this->get_field_id('dribbble'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('ffffound'); ?>"><?php _e('Ffffound URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('ffffound'); ?>" value="<?php echo $ffffound; ?>" class="widefat" id="<?php echo $this->get_field_id('ffffound'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('pinterest'); ?>" value="<?php echo $pinterest; ?>" class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('zootool'); ?>"><?php _e('Zootool URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('zootool'); ?>" value="<?php echo $zootool; ?>" class="widefat" id="<?php echo $this->get_field_id('zootool'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('behance'); ?>"><?php _e('Behance Network URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('behance'); ?>" value="<?php echo $behance; ?>" class="widefat" id="<?php echo $this->get_field_id('behance'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('squidoo'); ?>"><?php _e('Squidoo URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('squidoo'); ?>" value="<?php echo $squidoo; ?>" class="widefat" id="<?php echo $this->get_field_id('squidoo'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('slideshare'); ?>"><?php _e('Slideshare URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('slideshare'); ?>" value="<?php echo $slideshare; ?>" class="widefat" id="<?php echo $this->get_field_id('slideshare'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('lastfm'); ?>"><?php _e('Last.fm URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('lastfm'); ?>" value="<?php echo $lastfm; ?>" class="widefat" id="<?php echo $this->get_field_id('lastfm'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('grooveshark'); ?>"><?php _e('Grooveshark URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('grooveshark'); ?>" value="<?php echo $grooveshark; ?>" class="widefat" id="<?php echo $this->get_field_id('grooveshark'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('soundcloud'); ?>"><?php _e('Soundcloud URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('soundcloud'); ?>" value="<?php echo $soundcloud; ?>" class="widefat" id="<?php echo $this->get_field_id('soundcloud'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('foursquare'); ?>"><?php _e('Foursquare URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('foursquare'); ?>" value="<?php echo $foursquare; ?>" class="widefat" id="<?php echo $this->get_field_id('foursquare'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('gowalla'); ?>"><?php _e('Gowalla URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('gowalla'); ?>" value="<?php echo $gowalla; ?>" class="widefat" id="<?php echo $this->get_field_id('gowalla'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('linkedin'); ?>" value="<?php echo $linkedin; ?>" class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('xing'); ?>"><?php _e('Xing URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('xing'); ?>" value="<?php echo $xing; ?>" class="widefat" id="<?php echo $this->get_field_id('xing'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('wordpress'); ?>"><?php _e('WordPress URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('wordpress'); ?>" value="<?php echo $wordpress; ?>" class="widefat" id="<?php echo $this->get_field_id('wordpress'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('tumblr'); ?>" value="<?php echo $tumblr; ?>" class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS-Feed URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('rss'); ?>" value="<?php echo $rss; ?>" class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" />
				</p>

		<p>
						<label for="<?php echo $this->get_field_id('rsscomments'); ?>"><?php _e('RSS for Comments URL:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('rsscomments'); ?>" value="<?php echo $rsscomments; ?>" class="widefat" id="<?php echo $this->get_field_id('rsscomments'); ?>" />
				</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['target'], true ); ?> id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" <?php checked( $target, 'on' ); ?>> <?php _e('Open all links in a new browser tab', 'nilmini'); ?></input>
		</p>

		<?php
	}
}

register_widget('nilmini_sociallinks');

/*-----------------------------------------------------------------------------------*/
/* Include a custom Video Widget
/*-----------------------------------------------------------------------------------*/

class nilmini_video extends WP_Widget {

	public function __construct() {
		parent::__construct( 'nilmini_video', __( 'Video Widget', 'nilmini' ), array(
			'classname'   => 'widget_nilmini_video',
			'description' => __( 'Show a custom featured video.', 'nilmini' ),
		) );
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$embedcode = $instance['embedcode'];

		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title">'.$title.'</h3>'; ?>

				<div class="video_widget">
			<div class="featured-video"><?php echo $embedcode; ?></div>
			</div><!-- end .video_widget -->

		 <?php
		 echo $after_widget;
	 }

	 function update($new_instance, $old_instance) {
			 return $new_instance;
	 }

	 function form($instance) {
		$title = esc_attr($instance['title']);
		$embedcode = esc_attr($instance['embedcode']);
		?>

		 <p>
						<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','nilmini'); ?></label>
						<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
				</p>

				<p>
						<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Video embed code:','nilmini'); ?></label>
				<textarea name="<?php echo $this->get_field_name('embedcode'); ?>" class="widefat" rows="6" id="<?php echo $this->get_field_id('embedcode'); ?>"><?php echo( $embedcode ); ?></textarea>
				</p>

		<?php
	}
}

register_widget('nilmini_video');
