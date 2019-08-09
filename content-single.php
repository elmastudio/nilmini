<?php
/**
 * The template for displaying content in the single.php template
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
		</header><!--end entry-header -->

		<ul class="entry-meta">
				<li class="post-date"><a href="<?php the_permalink(); ?>" title="<?php _e( 'Permalink', 'nilmini' ); ?>"><?php echo get_the_date(); ?></a></li>
				<li class="post-author"><?php _e('Posted by', 'nilmini') ?> <?php the_author_posts_link(); ?></li>
				<li class="comments-count"><?php comments_popup_link( __( '0 comments', 'nilmini' ), __( '1 comment', 'nilmini' ), __( '% comments', 'nilmini' ), 'comments-link', __( 'comments off', 'nilmini' ) ); ?></li>
			</ul><!-- end entry-meta -->

		<div class="entry-content">
			<?php if ( has_post_thumbnail() ): ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			<?php endif; ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'nilmini' ), 'after' => '</div>' ) ); ?>
		</div><!-- end entry-content -->

			<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
			<div class="author-info">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'nilmini_author_bio_avatar_size', 70 ) ); ?>
				<div class="author-description">
					<h3><?php printf( __( 'Author: %s', 'nilmini' ), "<a href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h3>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div><!-- end author-description -->
			</div><!-- end author-info -->

			<?php endif; ?>

	</div><!--end entry-wrap-->

		<footer class="cat-tags">
			<p><span class="cats"><?php the_category( ', ' ); ?></span>
			<?php $tags_list = get_the_tag_list( '', ', ' );
			if ( $tags_list ): ?>
			<span class="tags"><?php the_tags( '', ', ', '' ); ?></span>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit post', 'nilmini')); ?>
			</p>

			<?php // Share post buttons (short URL, Twitter, Facebook Like, Google+). Activated on theme options page.
			$options = get_option('nilmini_theme_options');
			if($options['share-single-posts'] or $options['share-posts']) : ?>
				<?php get_template_part( 'share-posts'); ?>
			<?php endif; ?>
		</footer><!-- end cat-tags -->

</article><!-- end post-<?php the_ID(); ?> -->
