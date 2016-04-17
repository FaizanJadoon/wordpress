<?php
/**
 * Custom template tags for Liveblog
 *
 * @package WordPress
 * @subpackage liveblog
 * @since Liveblog 1.0
 */

/*-----------------------------------------------------------------------------------*/
/*	Post and Header Classes
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'liveblog_layout_class' ) ) :
	function liveblog_layout_class() {
		
		$liveblog_class = '';
		
		if(is_home() || is_front_page() || is_search()) {
			if(get_theme_mod('main_layout') == 'clayout' || get_theme_mod('main_layout') == 'gslayout' || get_theme_mod('main_layout') == 'sglayout' || get_theme_mod('main_layout') == 'glayout') {
				$liveblog_class = 'masonry-home ' . get_theme_mod('main_layout');
			} else {
				$liveblog_class = get_theme_mod('main_layout');
			}
		}
		elseif(is_archive() || is_author()) {
			if(get_theme_mod('archive_layout') == 'clayout' || get_theme_mod('archive_layout') == 'gslayout' || get_theme_mod('archive_layout') == 'sglayout' || get_theme_mod('archive_layout') == 'glayout') {
				$liveblog_class = 'masonry-archive ' . get_theme_mod('archive_layout');
			} else {
				$liveblog_class = get_theme_mod('archive_layout');
			}
		}
		elseif( is_single() || is_page() ) {
            $liveblog_class = get_theme_mod('single_layout');
		}
		
		echo esc_attr( $liveblog_class );
	}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Add Span tag Around Categories and Archives Post Count
/*-----------------------------------------------------------------------------------*/
if(!function_exists('liveblog_cat_count')){ 
	function liveblog_cat_count($links) {
		return str_replace(array('</a> (',')'), array('<span class="cat-count">','</span></a>'), $links);
	}
}
add_filter('wp_list_categories', 'liveblog_cat_count');

if(!function_exists('liveblog_archive_count')){ 
	function liveblog_archive_count($links) {
	  	return str_replace(array('</a>&nbsp;(',')'), array('<span class="cat-count">','</span></a>'), $links);
	}
}
add_filter('get_archives_link', 'liveblog_archive_count');

/*-----------------------------------------------------------------------------------*/
/*	Modify <!--more--> Tag in Posts
/*-----------------------------------------------------------------------------------*/
// Prevent Page Scroll When Clicking the More Link
function liveblog_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'liveblog_remove_more_link_scroll' );

/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'liveblog_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Liveblog 1.0
 */
function liveblog_paging_nav() {
	
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'liveblog' ),
		'next_text' => __( 'Next &rarr;', 'liveblog' ),
	) );
	if (get_theme_mod('pagination_type', 'num' ) == 'num') :
		if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<div class="pagination loop-pagination">
				<?php echo $links; ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	else:
	?>
		<nav class="norm-pagination" role="navigation">
			<div class="nav-previous"><?php next_posts_link( '&larr; ' . __( 'Older posts', 'liveblog' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'liveblog' ).' &rarr;' ); ?></div>
		</nav>
	<?php
	endif;
}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Post Navigation
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'liveblog_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Liveblog 1.0
 */
function liveblog_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation single-box clearfix" role="navigation">
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				next_post_link('<div class="alignleft post-nav-links prev-link-wrapper"><div class="next-link"><span class="uppercase">'. __("Published In","liveblog") .'</span> %link '."</div></div>");
			else :
				previous_post_link( '<div class="alignleft post-nav-links prev-link-wrapper"><div class="prev-link">%link'.'</div></div>', __('Previous Article','liveblog') );
				next_post_link( '<div class="alignright post-nav-links next-link-wrapper"><div class="next-link">%link'.'</div></div>', __( 'Next Article','liveblog') );
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
