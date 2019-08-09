<?php
/**
 * The template for displaying image attachments.
 *
 * @package WordPress
 * @subpackage Nilmini
 * @since Nilmini 1.0
 */

get_header(); ?>

<div id="content" class="clearfix">	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-wrap">

				<header class="entry-header">			
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!--end entry-header -->
			
				<ul class="entry-meta">	
					<li class="post-date"><a href="<?php the_permalink(); ?>" title="<?php _e( 'Permalink', 'nilmini' ); ?>"><?php echo get_the_date(); ?></a></li>
					<li class="comments-count"><?php comments_popup_link( __( '0 comments', 'nilmini' ), __( '1 comment', 'nilmini' ), __( '% comments', 'nilmini' ), 'comments-link', __( 'comments off', 'nilmini' ) ); ?></li>
					<li class="post-author"><?php
								$metadata = wp_get_attachment_metadata();
								printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s px</a><br/>in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'nilmini' ),
									esc_attr( get_the_time() ),
									get_the_date(),
									esc_url( wp_get_attachment_url() ),
									$metadata['width'],
									$metadata['height'],
									esc_url( get_permalink( $post->post_parent ) ),
									get_the_title( $post->post_parent )
								);
							?></li>
				</ul><!-- end entry-meta -->
				
			<div class="entry-content">
				<div class="entry-attachment">
					<div class="attachment">
<?php
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
	 */
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
								<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
								$attachment_size = apply_filters( 'theme_attachment_size', 848 );
								echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1024 ) ); // filterable image width with 1024px limit for image height.
								?></a>

								<?php if ( ! empty( $post->post_excerpt ) ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
								<?php endif; ?>
							</div><!-- .attachment -->

						</div><!-- .entry-attachment -->
						
						<nav id="image-nav">
							<span class="next-image"><?php next_image_link( false, __( 'Next Image &rarr;' , 'nilmini' ) ); ?></span>
							<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous Image' , 'nilmini' ) ); ?></span>
						</nav><!-- #image-nav -->
					
					</div><!-- end entry-content -->	
		</article><!-- #post-<?php the_ID(); ?> -->
	
		<?php comments_template(); ?>
	
	</div><!--end content-->

<?php get_footer(); ?>