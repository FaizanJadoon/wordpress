<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>	
<!-- Meta info -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<!-- Title -->
<?php global $bresponZive_tpcrn_data;?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
 
<?php if($bresponZive_tpcrn_data['custom_favicon']): ?>
<link rel="shortcut icon" href="<?php echo esc_url($bresponZive_tpcrn_data['custom_favicon']); ?>" /> <?php endif;  ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- CSS + jQuery + JavaScript --> 

<!--[if lt IE 9]> 
<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/css/ie8.css' type='text/css' media='all' />
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.js"></script>
<![endif]-->
<!--[if  IE 9]>
<link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/css/ie9.css' type='text/css' media='all' /> 
<![endif]-->
<?php wp_head();?>
</head>

<body <?php body_class();?>> 

<!-- #wrapper -->	
<div id="wrapper" class="container clearfix"> 
   <?php 
     if ( has_nav_menu('topNav') ){ 
   ?>
	<!-- #CatNav -->  
	<div id="catnav">	
		<?php wp_nav_menu(array('theme_location' => 'topNav','container'=> '','menu_id'=> 'catmenu','menu_class'=> ' container clearfix','fallback_cb' => 'false','depth' => 3)); ?>
	</div> 
	<!-- /#CatNav -->  
	<?php } ?> 
<!-- /#Header --> 
<div id="wrapper-container"> 

<div id="header">	
	<div id="head-content" class="clearfix ">
 	<!-- Logo --> 
			<div id="logo">   
				<?php if($bresponZive_tpcrn_data['custom_logo'] !='') { 
				if($bresponZive_tpcrn_data['custom_logo']) {  $logo = $bresponZive_tpcrn_data['custom_logo']; 		
				} else { $logo = get_template_directory_uri() . '/images/logo.png'; 	
				} ?>  <a href="<?php echo esc_url( home_url( '/' ) );  ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo( 'name' ) ?>" /></a>    
				<?php } else { ?>   
				<?php if (is_home()) { ?>     
				<h1><a href="<?php echo esc_url( home_url( '/' ) );  ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> <span><?php bloginfo( 'description' ); ?></span>
				<?php } else { ?>  
				<h2><a href="<?php echo esc_url( home_url( '/' ) );  ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>  
				<?php } } ?>   
			</div>	 	
			<!-- /#Logo -->
 	</div>	
 </div>
<!-- /#Header --> 

   <?php 
     if ( has_nav_menu('mainNav') ){ 
   ?>
	<!-- #CatNav -->  
	<div id="catnav" class="secondary">	
		<?php wp_nav_menu(array('theme_location' => 'mainNav','container'=> '','menu_id'=> 'catmenu','menu_class'=> 'catnav  container clearfix','fallback_cb' => 'false','depth' => 3)); ?>
	</div> 
	<!-- /#CatNav -->  
	<?php } ?> 
 
	<!--[if lt IE 8]>
		<div class="msgnote"> 
			Your browser is <em>too old!</em> <a rel="nofollow" href="http://browsehappy.com/">Upgrade to a different browser</a> to experience this site. 
		</div>
	<![endif]-->	