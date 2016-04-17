<div class="author-box">
	<h3 class="section-heading uppercase"><?php _e('About Author','liveblog'); ?></h3>
	<div class="author-box-avtar">
		<?php echo get_avatar( get_the_author_meta('email'), '100' ); ?>
	</div>
	<div class="author-info-container">
		<div class="author-info">
			<div class="author-head">
				<h5><?php the_author_meta('display_name'); ?></h5>
			</div>
			<p><?php the_author_meta('description') ?></p>
		</div>
	</div>
</div>