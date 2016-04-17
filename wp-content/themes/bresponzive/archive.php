<?php get_header(); ?>		
<?php global $bresponZive_tpcrn_data;?>
<div id="blocks-wrapper" class="clearfix">
	<div id="blocks-left" class="eleven columns clearfix">	
 			<!--Archive content-->
		<!-- .blogposts-wrapper-->
  
 					 		<h2 class="blogpost-wrapper-title" style="margin-top:30px;">
 							<?php if(is_day()): ?>
 								<?php printf(__('Daily Archives: %s', 'bresponZive'), get_the_date()); ?>
 							<?php elseif(is_month()) : ?>
 								<?php printf(__('Monthly Archives: %s', 'bresponZive'), get_the_date('F Y')); ?>
 							<?php elseif(is_year()) : ?>
 								<?php printf(__('Yearly Archives: %s', 'bresponZive'), get_the_date('Y')); ?>
 							<?php elseif(is_category() || is_tag()): ?>
 								<?php printf(__('Articles Posted in the " %s " Category', 'bresponZive'), single_cat_title('', false)); ?>
 							<?php elseif(is_author()):  	?>	
 								<?php printf(__('Articles Posted by the Author: %s', 'bresponZive'), $curauth->nickname);  ?>
 							<?php else: ?>
 								<?php _e('Blog Archives', 'bresponZive'); ?>
 							<?php endif; ?>
  						</h2> 
						<?php   get_template_part( 'includes/blog', 'loop' );?>
  			
 	</div>
 			<!-- END MAIN -->
 <?php get_sidebar(); ?>
 <?php get_footer(); ?>