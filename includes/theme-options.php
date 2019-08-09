<?php
/**
 * Nilmini Theme Options
 *
 * @package WordPress
 * @subpackage Nilmini
 * @since Nilmini 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Properly enqueue styles and scripts for our theme options page.
/*
/* This function is attached to the admin_enqueue_scripts action hook.
/*
/* @param string $hook_suffix The action passes the current page to the function.
/* We don't do anything if we're not on our theme options page.
/*-----------------------------------------------------------------------------------*/

function nilmini_admin_enqueue_scripts( $hook_suffix ) {
	if ( $hook_suffix != 'appearance_page_theme_options' )
		return;

	wp_enqueue_style( 'nilmini-theme-options', get_template_directory_uri() . '/includes/theme-options.css', false, '2011-04-28' );
	wp_enqueue_script( 'nilmini-theme-options', get_template_directory_uri() . '/includes/theme-options.js', array( 'farbtastic' ), '2011-04-28' );
	wp_enqueue_style( 'farbtastic' );
}
add_action( 'admin_enqueue_scripts', 'nilmini_admin_enqueue_scripts' );


/*-----------------------------------------------------------------------------------*/
/* Register the form setting for our nilmini_options array.
/*
/* This function is attached to the admin_init action hook.
/*
/* This call to register_setting() registers a validation callback, nilmini_theme_options_validate(),
/* which is used when the option is saved, to ensure that our option values are complete, properly
/* formatted, and safe.
/*
/* We also use this function to add our theme option if it doesn't already exist.
/*-----------------------------------------------------------------------------------*/

function nilmini_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === nilmini_get_theme_options() )
		add_option( 'nilmini_theme_options', nilmini_get_default_theme_options() );

	register_setting(
		'nilmini_options',       // Options group, see settings_fields() call in theme_options_render_page()
		'nilmini_theme_options', // Database option, see nilmini_get_theme_options()
		'nilmini_theme_options_validate' // The sanitization callback, see nilmini_theme_options_validate()
	);
}
add_action( 'admin_init', 'nilmini_theme_options_init' );

/*-----------------------------------------------------------------------------------*/
/* Add our theme options page to the admin menu.
/*
/* This function is attached to the admin_menu action hook.
/*-----------------------------------------------------------------------------------*/

function nilmini_theme_options_add_page() {
	add_theme_page(
		__( 'Theme Options', 'nilmini' ), // Name of page
		__( 'Theme Options', 'nilmini' ), // Label in menu
		'edit_theme_options',                  // Capability required
		'theme_options',                       // Menu slug, used to uniquely identify the page
		'theme_options_render_page'            // Function that renders the options page
	);
}
add_action( 'admin_menu', 'nilmini_theme_options_add_page' );

/*-----------------------------------------------------------------------------------*/
/* Returns an array of font options registered for Nilmini.
/*-----------------------------------------------------------------------------------*/

function nilmini_fonts() {
	$fonts_options = array(
		'font-serif' => array (
			'value' => 'font-serif',
			'label' => __( 'serif', 'nilmini' ),
			'thumbnail' => get_template_directory_uri() . '/includes/images/serif.png',
		),
		'font-sansserif' => array(
			'value' => 'font-sansserif',
			'label' => __( 'sans-serif', 'nilmini' ),
			'thumbnail' => get_template_directory_uri() . '/includes/images/sansserif.png',
		),
	);

	return apply_filters( 'nilmini_fonts', $fonts_options );
}

/*-----------------------------------------------------------------------------------*/
/* Returns an array of layout options registered for Nilmini.
/*-----------------------------------------------------------------------------------*/

function nilmini_layouts() {
	$layout_options = array(
		'meta-right' => array(
			'value' => 'meta-right',
			'label' => __( 'Posts meta info right', 'nilmini' ),
			'thumbnail' => get_template_directory_uri() . '/includes/images/meta-right.png',
		),
		'meta-left' => array(
			'value' => 'meta-left',
			'label' => __( 'Posts meta info left', 'nilmini' ),
			'thumbnail' => get_template_directory_uri() . '/includes/images/meta-left.png',
		),
	);

	return apply_filters( 'nilmini_layouts', $layout_options );
}

/*-----------------------------------------------------------------------------------*/
/* Returns the default options for Nilmini.
/*-----------------------------------------------------------------------------------*/

function nilmini_get_default_theme_options() {
	$default_theme_options = array(
		'link_color'   => '#E84D38',
		'theme_fonts' => 'font-serif',
		'theme_layout' => 'meta-right',
		'custom_logo' => '',
		'header_search' => '',
		'custom_headerslogan' => '',
		'custom_footertext' => '',
		'custom_favicon' => '',
		'share-posts' => '',
		'share-single-posts' => '',
		'hide_submenus' => '',
	);

	return apply_filters( 'nilmini_default_theme_options', $default_theme_options );
}

/*-----------------------------------------------------------------------------------*/
/* Returns the options array for Nilmini.
/*-----------------------------------------------------------------------------------*/

function nilmini_get_theme_options() {
	return get_option( 'nilmini_theme_options' );
}

/*-----------------------------------------------------------------------------------*/
/* Returns the options array for Nilmini.
/*-----------------------------------------------------------------------------------*/

function theme_options_render_page() {
	?>
	<div class="wrap">
		<h2><?php printf( __( '%s Theme Options', 'nilmini' ), wp_get_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'nilmini_options' );
				$options = nilmini_get_theme_options();
				$default_options = nilmini_get_default_theme_options();
			?>

			<table class="form-table">

				<tr valign="top"><th scope="row"><?php _e( 'Custom Link Color', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Link Color', 'nilmini' ); ?></span></legend>
							<input type="text" name="nilmini_theme_options[link_color]" id="link-color" value="<?php echo esc_attr( $options['link_color'] ); ?>" />
							<a href="#" class="pickcolor hide-if-no-js" id="link-color-example"></a>
							<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color', 'nilmini' ); ?>">
							<div id="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
							<br />
							<small class="description"><?php printf( __( 'Default color: %s', 'nilmini' ), $default_options['link_color'] ); ?></small>
						</fieldset>
					</td>
				</tr>

				<tr valign="top" class="image-radio-option"><th scope="row"><?php _e( 'Font Option', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Font Option', 'nilmini' ); ?></span></legend>
						<?php
							foreach ( nilmini_fonts() as $fonts ) {
								?>

								<label class="description">
									<input type="radio" name="nilmini_theme_options[theme_fonts]" value="<?php echo esc_attr( $fonts['value'] ); ?>" <?php checked( $options['theme_fonts'], $fonts['value'] ); ?> />
									<span>
										<img src="<?php echo esc_url( $fonts['thumbnail'] ); ?>"/>
										<?php echo $fonts['label']; ?>
									</span>
								</label>
								</div>
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<tr valign="top" class="image-radio-option"><th scope="row"><?php _e( 'Layout Option', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Layout Option', 'nilmini' ); ?></span></legend>
						<?php
							foreach ( nilmini_layouts() as $layout ) {
								?>
								<div class="layout">
								<label class="description">
									<input type="radio" name="nilmini_theme_options[theme_layout]" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $options['theme_layout'], $layout['value'] ); ?> />
									<span>
										<img src="<?php echo esc_url( $layout['thumbnail'] ); ?>"/>
										<?php echo $layout['label']; ?>
									</span>
								</label>
								</div>
								<?php
							}
						?>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Custom Logo Image', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom Logo image', 'nilmini' ); ?></span></legend>
							<input class="regular-text" type="text" name="nilmini_theme_options[custom_logo]" value="<?php esc_attr_e( $options['custom_logo'] ); ?>" />
						<br/><label class="description" for="nilmini_theme_options[custom_logo]"><a href="<?php echo home_url(); ?>/wp-admin/media-new.php" target="_blank"><?php _e('Upload your own logo image', 'nilmini'); ?></a> <?php _e(' using the WordPress Media Library and then insert the URL here', 'nilmini'); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Hide header search form', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Deactivate search form in header', 'nilmini' ); ?></span></legend>
							<input id="nilmini_theme_options[header_search]" name="nilmini_theme_options[header_search]" type="checkbox" value="1" <?php checked( '1', $options['header_search'] ); ?> />
							<label class="description" for="nilmini_theme_options[header_search]"><?php _e( 'Check this box to hide the search form in the header.', 'nilmini' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Custom Header Slogan', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom Header Slogan', 'nilmini' ); ?></span></legend>
							<textarea id="nilmini_theme_options[custom_headerslogan]" class="small-text" cols="100" rows="4" name="nilmini_theme_options[custom_headerslogan]"><?php echo esc_textarea( $options['custom_headerslogan'] ); ?></textarea>
						<br/><label class="description" for="nilmini_theme_options[custom_headerslogan]"><?php _e( 'If you want to show a header slogan text, insert your slogan text here.', 'nilmini' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Custom Footer text', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom Footer text', 'nilmini' ); ?></span></legend>
							<textarea id="nilmini_theme_options[custom_footertext]" class="small-text" cols="100" rows="4" name="nilmini_theme_options[custom_footertext]"><?php echo esc_textarea( $options['custom_footertext'] ); ?></textarea>
						<br/><label class="description" for="nilmini_theme_options[custom_footertext]"><?php _e( 'Customize the footer credit text. Standard HTML is allowed.', 'nilmini' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Custom Favicon', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Custom Favicon', 'nilmini' ); ?></span></legend>
							<input class="regular-text" type="text" name="nilmini_theme_options[custom_favicon]" value="<?php esc_attr_e( $options['custom_favicon'] ); ?>" />
						<br/><label class="description" for="nilmini_theme_options[custom_favicon]"><?php _e( 'Create a favicon image, upload your .ico Favicon image (via FTP) to your server and enter the Favicon URL here.', 'nilmini' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Share post buttons', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Share post buttons', 'nilmini' ); ?></span></legend>
							<input id="nilmini_theme_options[share-posts]" name="nilmini_theme_options[share-posts]" type="checkbox" value="1" <?php checked( '1', $options['share-posts'] ); ?> />
							<label class="description" for="nilmini_theme_options[share-posts]"><?php _e( 'Check this box to include a post short URL, Twitter, Facebook and Google+ button on the blogs front page and on single post pages.', 'nilmini' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Share post buttons on single posts only', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Share post buttons on single posts only', 'nilmini' ); ?></span></legend>
							<input id="nilmini_theme_options[share-single-posts]" name="nilmini_theme_options[share-single-posts]" type="checkbox" value="1" <?php checked( '1', $options['share-single-posts'] ); ?> />
							<label class="description" for="nilmini_theme_options[share-single-posts]"><?php _e( 'Check this box to include the share post buttons <strong>only</strong> on single post pages.', 'nilmini' ); ?></label>
						</fieldset>
					</td>
				</tr>

				<tr valign="top"><th scope="row"><?php _e( 'Hide sub menus on mobile devices', 'nilmini' ); ?></th>
					<td>
						<fieldset><legend class="screen-reader-text"><span><?php _e( 'Hide sub menus on mobile devices', 'nilmini' ); ?></span></legend>
							<input id="nilmini_theme_options[hide_submenus]" name="nilmini_theme_options[hide_submenus]" type="checkbox" value="1" <?php checked( '1', $options['hide_submenus'] ); ?> />
							<label class="description" for="nilmini_theme_options[hide_submenus]"><?php _e( 'Check this box to hide the main navigation sub menus on mobile devices (tablets and smartphones). With this option your readers can focus mainly on your latest articles even if they view your site on small screens.', 'nilmini' ); ?></label>
						</fieldset>
					</td>
				</tr>

			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/*-----------------------------------------------------------------------------------*/
/* Sanitize and validate form input. Accepts an array, return a sanitized array.
/*-----------------------------------------------------------------------------------*/

function nilmini_theme_options_validate( $input ) {
	global $layout_options, $font_options;

	// Link color must be 3 or 6 hexadecimal characters
	if ( isset( $input['link_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['link_color'] ) )
			$output['link_color'] = '#' . strtolower( ltrim( $input['link_color'], '#' ) );

	// Theme font must be in our array of theme fonts options
	if ( isset( $input['theme_fonts'] ) && array_key_exists( $input['theme_fonts'], nilmini_fonts() ) )
		$output['theme_fonts'] = $input['theme_fonts'];

	// Theme layout must be in our array of theme layout options
	if ( isset( $input['theme_layout'] ) && array_key_exists( $input['theme_layout'], nilmini_layouts() ) )
		$output['theme_layout'] = $input['theme_layout'];

	// Text options must be safe text with no HTML tags
	$input['custom_logo'] = wp_filter_nohtml_kses( $input['custom_logo'] );
	$input['custom_favicon'] = wp_filter_nohtml_kses( $input['custom_favicon'] );

	// checkbox value is either 0 or 1
	if ( ! isset( $input['share-posts'] ) )
		$input['share-posts'] = null;
	$input['share-posts'] = ( $input['share-posts'] == 1 ? 1 : 0 );

	if ( ! isset( $input['share-single-posts'] ) )
		$input['share-single-posts'] = null;
	$input['share-single-posts'] = ( $input['share-single-posts'] == 1 ? 1 : 0 );

	if ( ! isset( $input['header_search'] ) )
		$input['header_search'] = null;
	$input['header_search'] = ( $input['header_search'] == 1 ? 1 : 0 );

	if ( ! isset( $input['hide_submenus'] ) )
		$input['hide_submenus'] = null;
	$input['hide_submenus'] = ( $input['hide_submenus'] == 1 ? 1 : 0 );

	return $input;
}

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current link color.
/*
/* This function is attached to the wp_head action hook.
/*-----------------------------------------------------------------------------------*/

function nilmini_print_link_color_style() {
	$options = nilmini_get_theme_options();
	$link_color = $options['link_color'];

	$default_options = nilmini_get_default_theme_options();

	// Don't do anything if the current link color is the default.
	if ( $default_options['link_color'] == $link_color )
		return;
?>
<style>
/* Custom link color */
body {border-top:6px solid <?php echo $link_color; ?>;}
a, #site-title h1 a, #content .entry-header h2.entry-title a:hover, #main-nav ul ul a:hover, #content .entry-meta .cat-links a:hover, #content .entry-meta a:hover, #content .cat-tags a:hover, #respond a:hover, a.post-edit-link:hover, #comments a.comment-reply-link:hover, .comment-header a.comment-time:hover, .comment-header a.comment-edit-link:hover , a#cancel-comment-reply-link:hover, .widget_calendar table#wp-calendar tbody tr td a, #smart-archives-list a:hover, ul#smart-archives-block li a:hover, #colophon #site-generator a:hover, .widget_calendar table#wp-calendar tfoot tr td#prev a:hover, .widget_calendar table#wp-calendar tfoot tr td#next a:hover, a.rsswidget:hover, .page-link a:hover, .widget ul li a:hover, .tagcloud a:hover, h3.widget-title a:hover {color: <?php echo $link_color; ?>;}
#main-nav ul li a:hover, #content .post .entry-summery a:hover, input#submit:hover, input.wpcf7-submit:hover, #content .wp-pagenavi a:hover, #content .format-link .entry-content a:hover, .nav-previous a:hover, .nav-next a:hover, .previous-image a:hover, .next-image a:hover {background:<?php echo $link_color; ?>;}
#main-nav ul li:hover > ul {color:<?php echo $link_color; ?>;}
#main-nav li:hover > a {background:<?php echo $link_color; ?>;}
#main-nav li li:hover > a {color:<?php echo $link_color; ?>;}
</style>
<?php
}
add_action( 'wp_head', 'nilmini_print_link_color_style' );


/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for the current font option.
/*
/* This function is attached to the wp_head action hook.
/*-----------------------------------------------------------------------------------*/

function nilmini_print_font_style() {
	$options = nilmini_get_theme_options();
	$theme_fonts = $options['theme_fonts'];

	$default_options = nilmini_get_default_theme_options();

	// Don't do anything if the current link color is the default.
	if ( $default_options['theme_fonts'] == $theme_fonts )
		return;
?>
<style>
/* sans-serif fonts */
#header #header-slogan p {font: italic 1.4em/1.5 'Helvetica Neue', Helvetica, Arial, sans-serif;}
#site-title h2#site-description {font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;}
#content .entry-wrap {font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;}
#content .entry-header h1.entry-title {font-size:1.5em; font-weight:bold;}
#content .entry-header h2.entry-title {font-size:1.4em; font-weight:bold;}
.entry-content h2, .entry-content h3 {font-weight:bold;}
#content .format-link .entry-content a {font-style:normal;}
h2 {font-size:1.4em;}
h3 {font-size:1.3em;}
</style>
<?php
}
add_action( 'wp_head', 'nilmini_print_font_style' );

/*-----------------------------------------------------------------------------------*/
/* Add a style block to the theme for optimized mobile main menu.
/*
/* This function is attached to the wp_head action hook.
/*-----------------------------------------------------------------------------------*/

function nilmini_print_hide_submenus_style() {
	$options = nilmini_get_theme_options();
	$hide_submenus = $options['hide_submenus'];

		$default_options = nilmini_get_default_theme_options();

	// Don't do anything if the current option is the default.
	if ( $default_options['hide_submenus'] == $hide_submenus )
		return;
?>
<style>
@media screen and (max-width: 1024px) {
#main-nav ul ul,
#main-nav ul ul ul,
#main-nav ul li ul li {
	display:none;
	margin:0;
}
}
</style>
<?php
}
add_action( 'wp_head', 'nilmini_print_hide_submenus_style' );



/*-----------------------------------------------------------------------------------*/
/* Add layout classes to the array of body classes.
/*-----------------------------------------------------------------------------------*/

function nilmini_layout_classes( $existing_classes ) {
	$options = nilmini_get_theme_options();
	$current_layout = $options['theme_layout'];

	if ( in_array( $current_layout, array( 'meta-right', 'meta-left' ) ) )
		$classes = array( 'two-column' );
	else
		$classes = array( 'one-column' );

	$classes[] = $current_layout;

	$classes = apply_filters( 'nilmini_layout_classes', $classes, $current_layout );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'nilmini_layout_classes' );
