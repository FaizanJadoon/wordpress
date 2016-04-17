<?php get_header(); ?>
<div class="main-wrapper clearfix">
	<div id="page">
		<div class="main-content">
			<div class="content-area">
				<div class="content-page">
					<div class="content-detail">
						<div class="page-content">
							<div class="post-box error-page-content">
								<div class="error-head"><span><?php _e('Oops, This Page Could Not Be Found!','liveblog'); ?></span></div>
								<div class="error-text"><?php _e('404','liveblog'); ?></div>
								<p><a href="<?php echo esc_url( home_url() ); ?>"><?php _e('Back to Homepage','liveblog'); ?></a></p>
								<p>
									<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'liveblog' ); ?>
								</p>
								<?php get_search_form(); ?>
							</div>
						</div><!--.page-content-->
					</div>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div><!--.main-content-->
<?php get_footer();?>