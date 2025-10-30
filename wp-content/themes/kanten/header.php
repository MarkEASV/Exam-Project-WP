<?php wp_head(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <nav class="navBar" aria-label="Navigation Bar">
        <div class="navBarGrid">
            <div class="logoImg">
<a href="<?php echo esc_url( pll_home_url() ); ?>">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/kantenLogo_white_transparent.webp" alt="Kanten Logo">
</a>
            </div>
            <ul class="languages"><li><?php pll_the_languages(); ?></li></ul>
<ul class="ulNav">
    <li>
        <button id="searchToggle" class="sr-only-button" aria-label="søg">    
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        </button>
    </li>
    <li><a href="#"><?php pll_e("events") ?></a></li>
    <li><a href="<?php echo esc_url( kanten_pll_permalink_by_path('blogsview') ); ?>"><?php pll_e("blogs") ?></a></li>
    <li><a href="<?php echo esc_url( kanten_pll_permalink_by_path('sustainability-initiatives') ); ?>"><?php pll_e("bæredygtighed") ?></a></li>
    <li><a href="<?php echo esc_url( kanten_pll_wc_page_url('shop') ); ?>"><?php pll_e('Merch'); ?></a></li>
    <li><a href="#"><?php pll_e("om") ?></a></li>
    <li><a href="<?php echo esc_url( kanten_pll_wc_page_url('cart') ); ?>" aria-label="<?php pll_e('Cart'); ?>"><i class="fa-solid fa-cart-shopping" aria-hidden="true"></i></a></li>
    <li><a href="<?php echo esc_url( kanten_pll_wc_page_url('myaccount') ); ?>" aria-label="<?php pll_e('My Account'); ?>"><i class="fa-solid fa-user" aria-hidden="true"></i></a></li>
</ul>

            <div id="searchBar" class="searchBar">
                <form role="search" method="get" class="searchForm"
                      action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search"
                           name="s"
                           class="searchField"
                           placeholder="<?php pll_e('Søg efter...'); ?>"
                           value="<?php echo get_search_query(); ?>" />
                    <input type="hidden" name="lang" value="<?php echo esc_attr( pll_current_language('slug') ); ?>">
                    <button type="submit" class="searchSubmit"><?php pll_e('Søg'); ?></button>
                </form>
            </div>
        </div>
    </nav>

<body <?php body_class() ?>>