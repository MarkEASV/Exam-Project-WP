<?php 
function custom_theme_styles() {
    wp_enqueue_style('global-style', get_template_directory_uri() . '/style.css');

    wp_enqueue_style('frontpage-style', get_template_directory_uri() . '/assets/frontpage.css');
    wp_enqueue_style('blogsview-style', get_template_directory_uri() . '/assets/blogView.css');
    wp_enqueue_style('blog-style', get_template_directory_uri() . '/assets/blog.css');
    wp_enqueue_style('sustain-style', get_template_directory_uri() . '/assets/sustain.css');
}
    
   if (is_front_page()) {
        wp_enqueue_style('frontpage-style', get_template_directory_uri() . '/assets/frontpage.css');
    }

        if (is_singular('blog')) {
        wp_enqueue_style('blog-style', get_template_directory_uri() . '/assets/blog.css');
    }

        if (is_page('blogsview')) {
            wp_enqueue_style('blogsview-style', get_template_directory_uri() . '/assets/blogsview.css');
        }

add_action('wp_enqueue_scripts', 'custom_theme_styles');

function plp_register_strings() {
    pll_register_string("blogsview", "alle blogindlæg");
    pll_register_string("blogsview", "af");
    pll_register_string("blog", "skrevet af");
    pll_register_string("blog", "Relaterede Blogindlæg");

    pll_register_string("header", "events");
    pll_register_string("header", "blogs");
    pll_register_string("header", "bæredygtighed");
    pll_register_string("header", "om");
    pll_register_string("header", "støtte");

    pll_register_string("frontpage", "Kommende Events");
    pll_register_string("frontpage", "dato");
    pll_register_string("frontpage", "gratis");
    pll_register_string("frontpage", "seneste blogindlæg");
    pll_register_string("frontpage", "af_front");

    pll_register_string("footer", "Kundeservice");
    pll_register_string("footer", "Om kanten");
    pll_register_string("footer", "Bliv medlem");
    pll_register_string("footer", "Bestyrelsen");
    pll_register_string("footer", "Kontakt");
    pll_register_string("footer", "Privatlivspolitik");
    pll_register_string("footer", "Login");


}
add_action('init', 'plp_register_strings');

add_image_size( 'blog-thumb', 390, 220, true );
add_image_size( 'event-thumb', 595, 335, true );

