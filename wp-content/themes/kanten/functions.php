<?php 
function custom_theme_styles() {
    wp_enqueue_style('global-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('frontpage-style', get_template_directory_uri() . '/assets/frontpage.css');
}

add_action('wp_enqueue_scripts', 'custom_theme_styles');