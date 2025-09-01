<?php

function kanten_enqueue_styles() {
    wp_enqueue_style(
        'kanten-style',
        get_stylesheet_uri()
    );
}
add_action('wp_enqueue_scripts', 'kanten_enqueue_styles');
?>