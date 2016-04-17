<?php get_header(); ?>
  
<!--#blocks-wrapper-->
<div id="blocks-wrapper" class="clearfix">
<!--#blocks-left-or-right-->

	<div id="blocks-left" class="eleven columns clearfix">	
   			<?php   
		if(isset($bresponZive_tpcrn_data['offline_feat_slide'])) { if($bresponZive_tpcrn_data['offline_feat_slide'] =='1')  include_once('includes/flex-slider.php'); }?>
									<h2 class="blogpost-wrapper-title"><?php _e('Recent Posts','bresponZive');?> </h2>	
			<?php   get_template_part( 'includes/blog', 'loop' );?>
<!--homepage content-->
 							<?php dynamic_sidebar('Magazine Style Widgets)'); ?>
 
  			</div>
 			<!-- /blocks col -->
 <?php get_sidebar();  ?>
 <?php get_footer(); ?>