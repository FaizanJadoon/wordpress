<form method="get" class="searchform search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<fieldset> 
		<input type="text" name="s" class="s" value="<?php echo get_search_query(); ?>" placeholder="<?php _e('Type Here and Press Enter','liveblog'); ?>"> 
		
	</fieldset>
    <input type="submit" class="search-button" placeholder="<?php _e('Search','liveblog'); ?>" type="submit" value="<?php _e('Search','liveblog'); ?>">
</form>