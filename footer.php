 <?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Nilmini
 * @since Nilmini 1.0
 */
?>

	<footer id="colophon">

		<?php if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) ) : ?>

		<div id="supplementary" class="clearfix">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div id="first" class="widget-area">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- #first .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
			<div id="second" class="widget-area">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div><!-- #second .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
			<div id="third" class="widget-area">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div><!-- #third .widget-area -->
		<?php endif; ?>

	</div><!-- #supplementary -->
	<?php endif; ?>

		<div id="site-generator">
		<?php if (has_nav_menu( 'footer' ) ) {
				wp_nav_menu( array('theme_location' => 'footer', 'container' => 'nav' ,'depth' => 1 ));}
		?>

			<?php
				$options = get_option('nilmini_theme_options');
				if($options['custom_footertext'] != '' ){
					echo stripslashes($options['custom_footertext']);
				} else { ?>
					<p>&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?>  | <?php
						/* Include Privacy Policy link. */
						if ( function_exists( 'the_privacy_policy_link' ) ) {
						the_privacy_policy_link( '<span>', '</span>', 'nilmini');
						}
					?> | <?php _e('Proudly powered by', 'nilmini') ?> <a href="https://wordpress.org/" >WordPress</a><span class="sep"> | </span><?php printf( __( 'Theme: %1$s by %2$s', 'nilmini' ), 'Nilmini', '<a href="https://www.elmastudio.de/en/">Elmastudio</a>' ); ?></p>
			<?php } ?>

			<a href="#top-border" class="top"><?php _e('Back to Top &uArr;', 'nilmini') ?></a>
		</div><!-- end site generator -->
	</footer><!-- end colophon -->
</div><!-- end page -->

<?php // Include Tweet button Google+ button scripts if share-post buttons are activated (via theme options page).
$options = get_option('nilmini_theme_options');
if($options['share-single-posts'] or $options['share-posts']) : ?>
<script type="text/javascript" src="https://platform.twitter.com/widgets.js"></script>
<script type="text/javascript">
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
</script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
