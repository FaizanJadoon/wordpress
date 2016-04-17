<!-- .fluid_container-->
<div class="fluid_container clearfix">
   <!-- #camera_wrap_2 -->
  <div class="camera_wrap camera_orange_skin  " id="camera_wrap_2">
	<?php 
	$cat_nam='';
	 if(isset($bresponZive_tpcrn_data['feat_slide_category'])){$cat_nam=$bresponZive_tpcrn_data['feat_slide_category'];}
							$flex_posts = new WP_Query(array(
							'showposts' => 5,
							'category_name' => $cat_nam
						));?>
		  <?php while($flex_posts->have_posts()): $flex_posts->the_post(); ?>	
		
			<?php if(has_post_thumbnail()){ ?>
			
 				 <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
					
					<div data-thumb="<?php echo $image[0]; ?>" data-src="<?php echo $image[0]; ?>" data-link="<?php the_permalink(); ?>">
 							<div class="camera_caption moveFromLeft">
  							   	<div class="list-block-slide clearfix">
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3> 	
				 
 
						

			</div>
 							</div>
					 </div>	
 		 
		    <?php } ?>
					
		  <?php endwhile; ?>
		
		  <?php wp_reset_query();?>
			 

		  
 
	</div><!-- /#camera_wrap_2 -->
</div>
<!-- /.fluid_container -->

 
<div style="clear:both; display:block;"></div>