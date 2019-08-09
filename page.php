<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage Nilmini
 * @since Nilmini 1.0
 */

get_header(); ?>

	<div id="content" class="clearfix">
		<?php the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
			
			<?php comments_template( '', true ); ?>

	</div><!-- end content -->

<?php get_footer(); ?>