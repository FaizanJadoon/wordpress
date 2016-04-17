<?php if ( has_post_format( 'video' )) {
	echo '<span class="post-type post-type-video"><i class="fa fa-film"></i></span>';
  } else if ( has_post_format( 'audio' )) {
	echo '<span class="post-type post-type-audio"><i class="fa fa-music"></i></span>';
  } else if ( has_post_format( 'image' )) {
	echo '<span class="post-type post-type-image"><i class="fa fa-camera"></i></span>';
  } else if ( has_post_format( 'link' )) {
	echo '<span class="post-type post-type-link"><i class="fa fa-link"></i></span>';
  } else if ( has_post_format( 'quote' )) {
	echo '<span class="post-type post-type-quote"><i class="fa fa-quote-left"></i></span>';
  } else if ( has_post_format( 'gallery' )) {
	echo '<span class="post-type post-type-gallery"><i class="fa fa-th-large"></i></span>';
  } else if ( has_post_format( 'status' )) {
	echo '<span class="post-type post-type-status"><i class="fa fa-comment-o"></i></span>';
  } else if ( has_post_format( 'aside' )) {
	echo '<span class="post-type post-type-aside"><i class="fa fa-file-text-o"></i></span>';
  } else {
	echo '<span class="post-type post-type-standard"><i class="fa fa-thumb-tack"></i></span>';
  }
?>