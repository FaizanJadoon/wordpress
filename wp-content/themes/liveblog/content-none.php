<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-box">
		<div class="post-home error-page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'liveblog' ), admin_url( 'post-new.php' ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'liveblog' ); ?></p>
			<?php get_search_form(); ?>

			<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'liveblog' ); ?></p>
			<?php get_search_form(); ?>

			<?php endif; ?>
		</div><!--.post-home-->
	</div><!--.post-box-->
</article>