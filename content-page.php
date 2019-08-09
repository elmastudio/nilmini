<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Nilmini
 * @since Nilmini 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- end entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'nilmini' ), 'after' => '</div>' ) ); ?>
		</div><!-- end entry-content -->
	</div><!--end entry-wrap -->

	<?php edit_post_link( __( 'Edit page', 'nilmini'), '<div class="edit-link">', '</div>'); ?>
</article><!-- end post-<?php the_ID(); ?> -->