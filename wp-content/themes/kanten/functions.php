<?php 
function custom_theme_styles() {
    wp_enqueue_style('global-style', get_template_directory_uri() . '/style.css');

    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/mainJs.js', array(), null, true );
    
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        array(), 
    );

add_action('wp_enqueue_scripts', 'enqueue_search_styles');
    
   if (is_front_page()) {
        wp_enqueue_style('frontpage-style', get_template_directory_uri() . '/assets/frontpage.css');
    }

        if (is_singular('blog')) {
        wp_enqueue_style('blog-style', get_template_directory_uri() . '/assets/blog.css');
    }

      if (is_search()) {
        wp_enqueue_style('searchpage-style', get_template_directory_uri() . '/assets/searchpage.css');
    }
    
        if (is_page('blogsview')) {
            wp_enqueue_style('blogsview-style', get_template_directory_uri() . '/assets/blogsview.css');
        }

                if (is_page('sustainability-initiatives')) {
            wp_enqueue_style('sustain-style', get_template_directory_uri() . '/assets/sustain.css');
        }

                        if (is_page('merchview')) {
            wp_enqueue_style('merchview-style', get_template_directory_uri() . '/assets/merchview.css');
        }

                        if (is_singular('merch-item')) {
            wp_enqueue_style('merchItem-style', get_template_directory_uri() . '/assets/merchItem.css');
        }

                        if (is_page('searchpage')) {
            wp_enqueue_style('searchpage-style', get_template_directory_uri() . '/assets/searchpage.css');
        }
        
            wp_enqueue_style('shop-style', get_template_directory_uri() . "/assets/shop.css");
        
        }

add_action('wp_enqueue_scripts', 'custom_theme_styles');

function shop_enable_woocommerce() {
    add_theme_support('woocommerce');
}
add_action("after_setup_theme", "shop_enable_woocommerce");



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

    pll_register_string("sustain", "Vi sætter fokus på FN.");
    pll_register_string("sustain", "På Kanten arbejder vi for at skabe en kulturscene, hvor alle har lige muligheder. Musik og kunst kan være med til at åbne øjne og skabe forandring, og derfor har vi valgt at sætte fokus på ligestilling mellem kønnene.");
    pll_register_string("sustain", "Equality Week Event", "sustain");
    pll_register_string("sustain", "Drop det sædvanlige. Kom til Equality Week og oplev en uge med snak, idéer og oplevelser, der faktisk betyder noget. Mød folk, bliv provokeret, bliv inspireret og vær med til at rykke tingene.");
    pll_register_string("sustain", "dato: ");
    pll_register_string("sustain", "gratis");
    pll_register_string("sustain", "Interview med Dansk Kvindesamfund");
    pll_register_string("sustain", "I forbindelse med vores ligestillingsuge har vi talt med en repræsentant fra Dansk Kvindesamfund. Interviewet giver et indblik i de udfordringer og muligheder, der præger arbejdet med ligestilling i erhvervslivet, og sætter fokus på, hvorfor temaet også er vigtigt på scenen hos os på Kanten.");
    pll_register_string("sustain", "Blogindlæg om ligestilling");
    pll_register_string("sustain", "af_front");

}
add_action('init', 'plp_register_strings');

add_image_size( 'blog-thumb', 390, 220, true );
add_image_size( 'event-thumb', 595, 335, true );

// Register taxonomy term names with Polylang string translations
add_action('init', function () {
    $taxonomy = 'blog-category'; // taxonomy key
    $terms = get_terms(array(
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
    ));

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            pll_register_string('taxonomy_' . $taxonomy, $term->name, 'Taxonomies');
        }
    }
});

// When getting a term, swap the name for its translation
add_filter('get_term', function ($term) {
    if (!is_admin() && isset($term->taxonomy) && $term->taxonomy === 'blog-category') {
        $translated = pll__($term->name);
        if ($translated) {
            $term->name = $translated;
        }
    }
    return $term;
});

function form_handler() {
    // Sanitize input
    $name     = sanitize_text_field($_POST['name']);
    $age      = intval($_POST['age']);
    $preferred_day = sanitize_text_field($_POST['preferred_day']);
    $artists  = sanitize_text_field($_POST['artists']);
    $feedback = sanitize_textarea_field($_POST['feedback']);

    // Insert as a custom post
    $post_id = wp_insert_post([
        'post_type'   => 'survey_response',
        'post_status' => 'private',
        'post_title'  => 'Survey from ' . $name,
        'post_content'=> "Age: $age\nPreferred Day: $preferred_day\nArtists: $artists\nFeedback: $feedback",
    ]);

    // Redirect back with success flag
    wp_redirect($_SERVER["HTTP_REFERER"] . "?submitted=true");
    exit;
}
add_action('admin_post_handle_form_submission', 'form_handler');
add_action('admin_post_nopriv_handle_form_submission', 'form_handler');



// Register Survey Response post type
function register_survey_response_cpt() {
    register_post_type('survey_response', [
        'label' => 'Survey Responses',
        'public' => false,        // not visible on frontend
        'show_ui' => true,        // visible in admin dashboard
        'menu_position' => 25,
        'menu_icon' => 'dashicons-feedback', // nice icon
        'supports' => ['title','editor'],
    ]);
}
add_action('init', 'register_survey_response_cpt');

