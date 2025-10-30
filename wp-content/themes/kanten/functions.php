<?php 
// Disable WooCommerce Admin, Analytics, Marketing
add_filter( 'woocommerce_admin_disabled', '__return_true' );
add_filter( 'woocommerce_disable_marketplace_suggestions', '__return_true' );

// Prevent analytics, marketing, and notes from loading
add_action( 'before_woocommerce_init', function() {
    if ( class_exists( '\Automattic\WooCommerce\Admin\Loader' ) ) {
        remove_action( 'admin_init', [ \Automattic\WooCommerce\Admin\Loader::class, 'init' ] );
    }
});

add_action('init', function() {
    // Disable usage tracking
    remove_action('init', 'wc_tracker_send_tracking_data');
    remove_action('woocommerce_init', 'wc_tracker_send_tracking_data');
    add_filter('woocommerce_apply_tracking', '__return_false');
});

add_action('wp_dashboard_setup', function() {
    remove_meta_box('woocommerce_dashboard_status', 'dashboard', 'normal');
});

function custom_theme_styles() {
    // Global stylesheet
    wp_enqueue_style('global-style', get_template_directory_uri() . '/style.css');

    // Main JavaScript
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/mainJs.js', array(), null, true);

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        array()
    );

    // Search styles (your custom hook)
    // add_action('wp_enqueue_scripts', 'enqueue_search_styles');

    // Conditional styles
    if (is_front_page()) {
        wp_enqueue_style('frontpage-style', get_template_directory_uri() . '/assets/frontpage.css');
    }

    if (is_singular('blog')) {
        wp_enqueue_style('blog-style', get_template_directory_uri() . '/assets/blog.css');
    }

    if (is_search()) {
        wp_enqueue_style('searchpage-style', get_template_directory_uri() . '/assets/searchpage.css');
    }

    if (is_page_template('page-blogsview.php')) {
        wp_enqueue_style('blogsview-style', get_template_directory_uri() . '/assets/blogsview.css');
    }

    if (is_page_template('page-sustainability-initiatives.php')) {
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

    if (is_shop() || is_product() || is_product_category() || is_cart() || is_checkout() || is_account_page() || is_product_tag()) {
        wp_enqueue_style('shop-style', get_template_directory_uri() . '/assets/shop.css');
        add_filter('woocommerce_enqueue_styles', '__return_empty_array');

        wp_enqueue_style('woocommerce-desktop', plugins_url('woocommerce/assets/css/woocommerce.min.css'), array(), WC()->version);
    }
}
add_action('wp_enqueue_scripts', 'custom_theme_styles');

// Enable WooCommerce support
function shop_enable_woocommerce() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'shop_enable_woocommerce');

// Disable WooCommerce block styles (optional)
add_filter('woocommerce_blocks_register_assets', '__return_false');

// Disable WooCommerce Admin & Marketing
add_filter( 'woocommerce_admin_disabled', '__return_true' );
add_filter( 'woocommerce_disable_marketplace_suggestions', '__return_true' );

// Disable cart fragments except on cart/checkout
add_action( 'wp_enqueue_scripts', function() {
    if ( ! is_cart() && ! is_checkout() && ! is_account_page() ) {
        wp_dequeue_script( 'wc-cart-fragments' );
    }
}, 999 );

// Disable WooCommerce Blocks
add_filter( 'woocommerce_blocks_register_assets', '__return_false' );




function plp_register_strings() {
    pll_register_string("blogsview", "alle blogindlæg");
    pll_register_string("blogsview", "af");
    pll_register_string("blog", "skrevet af");
    pll_register_string("blog", "Relaterede Blogindlæg");

    pll_register_string("header", "events");
    pll_register_string("header", "blogs");
    pll_register_string("header", "bæredygtighed");
    pll_register_string("header", "om");
    pll_register_string("header", "Merch");
    pll_register_string("header", "Cart");
    pll_register_string("header", "My Account");

    pll_register_string("frontpage", "Velkommen til kanten!");
    pll_register_string("frontpage", "Kommende Events");
    pll_register_string("frontpage", "dato");
    pll_register_string("frontpage", "gratis");
    pll_register_string("frontpage", "Seneste blogindlæg");
    pll_register_string("frontpage", "af_front");
    pll_register_string("frontpage", "Giv din stemme på næste begivenheds tema!");
    pll_register_string("frontpage", "Tak for dit svar!");
    pll_register_string("frontpage", "Hvad skal være temaet for vores næste event?");
    pll_register_string("frontpage", "Forslag til andre temaer?");
    pll_register_string("frontpage", "Du skal være logget ind for at skrive en anmeldelse.");
    pll_register_string("frontpage", "Log ind her");
    pll_register_string("frontpage", "Læg en anmeldelse og efterlad dit præg på siden");
    pll_register_string("frontpage", "Hvad synes du om Kanten?");
    pll_register_string("frontpage", "Brugeranmeldelser");
    

    pll_register_string("footer", "Kundeservice");
    pll_register_string("footer", "Om kanten");
    pll_register_string("footer", "Bliv medlem");
    pll_register_string("footer", "Bestyrelsen");
    pll_register_string("footer", "Kontakt");
    pll_register_string("footer", "Privatlivspolitik");
    pll_register_string("footer", "Login");

    pll_register_string("sustain", "Vi sætter fokus på FN’s Verdensmål 5: Ligestilling mellem kønnene.");
    pll_register_string("sustain", "På Kanten arbejder vi for at skabe en kulturscene, hvor alle har lige muligheder. Musik og kunst kan være med til at åbne øjne og skabe forandring, og derfor har vi valgt at sætte fokus på ligestilling mellem kønnene.");
    pll_register_string("sustain", "Equality Week Event");
    pll_register_string("sustain", "Drop det sædvanlige. Kom til Equality Week og oplev en uge med snak, idéer og oplevelser, der faktisk betyder noget. Mød folk, bliv provokeret, bliv inspireret og vær med til at rykke tingene.");
    pll_register_string("sustain", "dato: ");
    pll_register_string("sustain", "gratis");
    pll_register_string("sustain", "Interview med Dansk Kvindesamfund");
    pll_register_string("sustain", "I forbindelse med vores ligestillingsuge har vi talt med en repræsentant fra Dansk Kvindesamfund. Interviewet giver et indblik i de udfordringer og muligheder, der præger arbejdet med ligestilling i erhvervslivet, og sætter fokus på, hvorfor temaet også er vigtigt på scenen hos os på Kanten.");
    pll_register_string("sustain", "Blogindlæg om ligestilling");
    pll_register_string("sustain", "af_front");

    pll_register_string("search", "Søger efter:");
    pll_register_string("search", "Intet fundet 404");
    pll_register_string("header", "Søg");
    pll_register_string("header", "Søg efter...");

}
add_action('init', 'plp_register_strings');

if (!function_exists('kanten_pll_permalink_by_path')) {
    function kanten_pll_permalink_by_path($path, $post_type = 'page') {
        $path = trim($path, '/');
        $page = get_page_by_path($path, OBJECT, $post_type);
        if (!$page) {
            return home_url('/' . $path . '/');
        }
        $id = function_exists('pll_get_post') ? pll_get_post($page->ID) : $page->ID;
        return get_permalink($id);
    }
}

if (!function_exists('kanten_pll_wc_page_url')) {
    function kanten_pll_wc_page_url($key) {
        if (!function_exists('wc_get_page_id')) return home_url('/');
        $id = wc_get_page_id($key);
        if ($id <= 0) return home_url('/');
        if (function_exists('pll_get_post')) {
            $id = pll_get_post($id);
        }
        return get_permalink($id);
    }
}

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

    // 🔒 Verify nonce for CSRF protection
    if (
        ! isset( $_POST['survey_form_nonce'] ) ||
        ! wp_verify_nonce( $_POST['survey_form_nonce'], 'survey_form_action' )
    ) {
        wp_die( 'Sikkerhedstjek mislykkedes. Prøv venligst igen.' );
    }

    // 🧼 Sanitize and validate inputs
    $user          = wp_get_current_user();
    $name          = $user && $user->exists() ? sanitize_text_field( $user->user_login ) : 'Anonymous';
    $preferred_theme = sanitize_text_field( $_POST['preferred_theme'] ?? '' );
    $feedback        = sanitize_textarea_field( $_POST['feedback'] ?? '' );

    if ( empty( $preferred_theme ) ) {
        wp_die( 'Vælg venligst et tema før du sender formularen.' );
    }

    // 🗂 Save as private custom post
    $post_id = wp_insert_post([
        'post_type'   => 'survey_response',
        'post_status' => 'private',
        'post_title'  => 'Survey from ' . $name,
        'post_content'=> "Preferred Theme: $preferred_theme\nFeedback: $feedback",
    ]);

    // 🚦 Redirect safely back with success flag
    wp_safe_redirect( add_query_arg( 'submitted', 'true', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_handle_form_submission', 'form_handler' );
add_action( 'admin_post_nopriv_handle_form_submission', 'form_handler' );

/**
 * Register the "Survey Responses" custom post type
 */
function register_survey_response_cpt() {
    register_post_type( 'survey_response', [
        'label'         => 'Survey Responses',
        'public'        => false,       // not visible on frontend
        'show_ui'       => true,        // visible in admin
        'menu_position' => 25,
        'menu_icon'     => 'dashicons-feedback',
        'supports'      => ['title', 'editor'],
    ] );
}
add_action( 'init', 'register_survey_response_cpt' );


function review_form_handler() {

    // 🔒 Verify nonce for CSRF protection
    if (
        ! isset( $_POST['review_form_nonce'] ) ||
        ! wp_verify_nonce( $_POST['review_form_nonce'], 'review_form_action' )
    ) {
        wp_die( 'Sikkerhedstjek mislykkedes. Prøv venligst igen.' );
    }

    // 🧼 Sanitize and validate input
    $user    = wp_get_current_user();
    $name    = $user && $user->exists() ? sanitize_text_field( $user->user_login ) : 'Anonymous';
    $review  = sanitize_textarea_field( $_POST['review'] ?? '' );

    if ( empty( $review ) ) {
        wp_die( 'Du skal skrive en anmeldelse, før du sender formularen.' );
    }

    // 🗂 Save as a private custom post
    $post_id = wp_insert_post([
        'post_type'   => 'kanten_review',
        'post_status' => 'private',
        'post_title'  => 'Review from ' . $name,
        'post_content'=> $review,
    ]);

    // 🚦 Redirect safely back with a success flag
    wp_safe_redirect( add_query_arg( 'submitted', 'true', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_handle_review_submission', 'review_form_handler' );
add_action( 'admin_post_nopriv_handle_review_submission', 'review_form_handler' );

/**
  * Register the "Kanten Reviews" custom post type
 */
function register_kanten_review_cpt() {
    register_post_type( 'kanten_review', [
        'label'         => 'Kanten Reviews',
        'public'        => true,                // visible on frontend
        'publicly_queryable' => false,          // not directly accessible via single URLs
        'exclude_from_search' => true,          // keeps them out of site search
        'show_ui'       => true,                // visible in admin dashboard
        'menu_position' => 26,
        'menu_icon'     => 'dashicons-admin-comments',
        'supports'      => [ 'title', 'editor' ],
    ] );
}
add_action( 'init', 'register_kanten_review_cpt' );


/**
 * Add "Approval Status" checkbox in the Review editor
 */
function kanten_review_meta_box() {
    add_meta_box(
        'kanten_review_approval',
        'Approval Status',
        'kanten_review_approval_meta_box_callback',
        'kanten_review',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'kanten_review_meta_box' );

function kanten_review_approval_meta_box_callback( $post ) {
    $approved = get_post_meta( $post->ID, '_kanten_review_approved', true );
    wp_nonce_field( 'kanten_review_save_meta', 'kanten_review_meta_nonce' );
    ?>
    <p>
        <label>
            <input type="checkbox" name="kanten_review_approved" value="1" <?php checked( $approved, '1' ); ?> />
            Mark as approved for display
        </label>
    </p>
    <?php
}

function kanten_review_save_meta( $post_id ) {
    if (
        ! isset( $_POST['kanten_review_meta_nonce'] ) ||
        ! wp_verify_nonce( $_POST['kanten_review_meta_nonce'], 'kanten_review_save_meta' )
    ) {
        return;
    }

    $approved = isset( $_POST['kanten_review_approved'] ) ? '1' : '0';
    update_post_meta( $post_id, '_kanten_review_approved', $approved );
}
add_action( 'save_post_kanten_review', 'kanten_review_save_meta' );


/**
 * Handle review form submission
 */
function handle_review_submission() {
    // Check login (prevents manual POSTs)
    if ( ! is_user_logged_in() ) {
        wp_die( 'Du skal være logget ind for at indsende en anmeldelse.' );
    }

    // Verify nonce
    if (
        ! isset( $_POST['review_form_nonce'] ) ||
        ! wp_verify_nonce( $_POST['review_form_nonce'], 'review_form_action' )
    ) {
        wp_die( 'Sikkerhedsfejl – prøv igen.' );
    }

    // Sanitize input
    $user    = wp_get_current_user();
    $review  = sanitize_textarea_field( $_POST['review'] ?? '' );
    $review  = mb_substr( $review, 0, 200 ); // enforce 200-character limit

    if ( empty( $review ) ) {
        wp_die( 'Du skal skrive en anmeldelse, før du sender formularen.' );
    }

    // Insert review post (public but only shown when approved)
    wp_insert_post( [
        'post_type'    => 'kanten_review',
        'post_status'  => 'publish', // make it public (so can be queried)
        'post_title'   => 'Review from ' . $user->user_login,
        'post_content' => $review,
        'meta_input'   => [
            '_kanten_review_approved' => '0', // not approved by default
        ],
    ] );

    // Redirect back with success flag
    wp_safe_redirect( add_query_arg( 'submitted', 'true', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_handle_review_submission', 'handle_review_submission' );
add_action( 'admin_post_nopriv_handle_review_submission', 'handle_review_submission' );


/**
 * Remove "Privat:" / "Private:" / "Protected:" prefixes from titles on the frontend
 */
add_filter( 'the_title', function( $title, $post_id ) {
    $post = get_post( $post_id );

    // Only target Kanten Reviews on the frontend
    if ( is_admin() || ! $post || $post->post_type !== 'kanten_review' ) {
        return $title;
    }

    $prefixes = [ 'Privat:', 'Private:', 'Protected:' ];
    foreach ( $prefixes as $prefix ) {
        if ( stripos( $title, $prefix ) === 0 ) {
            $title = trim( substr( $title, strlen( $prefix ) ) );
            break;
        }
    }

    return $title;
}, 10, 2 );


/**
 * 🔒 Enforce password rules site-wide for WooCommerce users
 */

// Apply on "My Account" password update
add_action( 'woocommerce_save_account_details_errors', function( $errors, $user ) {
    if ( isset( $_POST['password_1'] ) && ! empty( $_POST['password_1'] ) ) {
        $password = sanitize_text_field( $_POST['password_1'] );

        kanten_validate_password_strength( $password, $errors );
    }
}, 10, 2 );


// Apply on registration
add_filter( 'woocommerce_registration_errors', function( $errors, $username, $email ) {
    if ( isset( $_POST['password'] ) && ! empty( $_POST['password'] ) ) {
        $password = sanitize_text_field( $_POST['password'] );

        kanten_validate_password_strength( $password, $errors );
    }
    return $errors;
}, 10, 3 );


// Apply on password reset ("Lost your password?")
add_action( 'validate_password_reset', function( $errors, $user ) {
    if ( isset( $_POST['pass1'] ) && ! empty( $_POST['pass1'] ) ) {
        $password = sanitize_text_field( $_POST['pass1'] );

        kanten_validate_password_strength( $password, $errors );
    }
}, 10, 2 );


/**
 * Helper: password validation logic shared across all contexts
 */
function kanten_validate_password_strength( $password, $errors ) {
    if ( strlen( $password ) < 12 ) {
        $errors->add( 'password_too_short', __( 'Password must be at least 12 characters long.', 'your-textdomain' ) );
    }

    if ( ! preg_match( '/[A-Z]/', $password ) ) {
        $errors->add( 'password_missing_uppercase', __( 'Password must include at least one uppercase letter.', 'your-textdomain' ) );
    }

    if ( ! preg_match( '/[a-z]/', $password ) ) {
        $errors->add( 'password_missing_lowercase', __( 'Password must include at least one lowercase letter.', 'your-textdomain' ) );
    }

    if ( ! preg_match( '/[0-9]/', $password ) ) {
        $errors->add( 'password_missing_number', __( 'Password must include at least one number.', 'your-textdomain' ) );
    }

    if ( ! preg_match( '/[\W_]/', $password ) ) {
        $errors->add( 'password_missing_symbol', __( 'Password must include at least one special character.', 'your-textdomain' ) );
    }
}

//remove password strength message box
add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_script( 'wc-password-strength-meter' );
    wp_deregister_script( 'wc-password-strength-meter' );
}, 100 );