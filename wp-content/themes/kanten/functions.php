<?php 
function custom_theme_styles() {
    wp_enqueue_style('global-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'custom_theme_styles');