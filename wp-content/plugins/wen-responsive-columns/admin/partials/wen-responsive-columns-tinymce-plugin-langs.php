<?php
// This file is based on wp-includes/js/tinymce/langs/wp-langs.php

if ( ! defined( 'ABSPATH' ) )
    exit;

if ( ! class_exists( '_WP_Editors' ) )
    require( ABSPATH . WPINC . '/class-wp-editor.php' );

function wen_responsive_columns_tinymce_plugin_translation() {
    $strings = array(
        'button_title' => __( 'WEN Responsive Columns', 'wen-responsive-columns' ),
        'popup_title'  => __( 'WEN Responsive Columns Shortcode Generator', 'wen-responsive-columns' ),
    );
    $locale = _WP_Editors::$mce_locale;
    $translated = 'tinyMCE.addI18n("' . $locale . '.wen_responsive_columns", ' . json_encode( $strings ) . ");\n";

     return $translated;
}

$strings = wen_responsive_columns_tinymce_plugin_translation();
