<?php
/**
 * The template for displaying 404 error pages.
 *
 * @package WordPress
 * @subpackage Nilmini
 * @since Nilmini 1.0
 */

get_header(); ?>

<div id="content" class="clearfix">
	
		<article class="page">
			<div class="entry-wrap">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Not Found', 'nilmini' ); ?></h1>
				</header><!--end entry-header -->
		
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'nilmini' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- end entry-content -->
		
			<script type="text/javascript">
			// focus on search field after it has loaded
			document.getElementById('s') && document.getElementById('s').focus();
			</script>

			</div><!-- end entry-wrap -->
		</article><!--end page -->

</div><!--end content-->

<?php get_footer(); ?>