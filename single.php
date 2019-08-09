<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Nilmini
 * @since Nilmini 1.0
 */

get_header(); ?>

<div id="content" class="clearfix">
	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
		<?php get_template_part( 'content', 'single' ); ?>
		
			<?php comments_template( '', true ); ?>
		
		<?php endwhile; // end of the loop. ?>
	
		<nav id="nav-below">
			<div class="nav-next"><?php next_post_link( '%link', __( 'Next Post &rarr;', 'nilmini' ) ); ?></div>
			<div class="nav-previous"><?php previous_post_link( '%link', __( '&larr; Previous Post', 'nilmini' ) ); ?></div>
		</nav><!-- nav-below -->

</div><!--end content-->
	
<?php get_footer(); ?>