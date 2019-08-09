<?php
/**
 * The template for displaying posts in the Video Post Format
 *
 * @package WordPress
 * @subpackage Nilmini
 * @since Nilmini 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-wrap">
		<?php if (is_sticky()) echo __( '<h3 class="sticky-label">Featured</h3>', 'nilmini' ); ?>
		<header class="entry-header">			
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'nilmini' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header><!--end entry-header -->
			
			<ul class="entry-meta">	
				<li class="post-date"><a href="<?php the_permalink(); ?>" title="<?php _e( 'Permalink', 'nilmini' ); ?>"><?php echo get_the_date(); ?></a></li>
				<li class="post-author"><?php _e('Posted by', 'nilmini') ?> <?php the_author_posts_link(); ?></li>
				<li class="comments-count"><?php comments_popup_link( __( '0 comments', 'nilmini' ), __( '1 comment', 'nilmini' ), __( '% comments', 'nilmini' ), 'comments-link', __( 'comments off', 'nilmini' ) ); ?></li>
			</ul><!-- end entry-meta -->
		
			<div class="entry-content">
				<?php the_content( __( 'Continue Reading &rarr;', 'nilmini' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'nilmini' ), 'after' => '</div>' ) ); ?>
			</div><!-- end entry-content -->
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
			if( $options['share-posts'] ) : ?>
				<?php get_template_part( 'share-posts'); ?>
			<?php endif; ?>
		</footer><!-- end cat-tags -->

</article><!-- end post -<?php the_ID(); ?> -->