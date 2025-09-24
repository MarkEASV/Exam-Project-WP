<?php wp_head(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('Kanten'); ?></title>
    <?php ?>
</head>
    <nav class="navBar" aria_labbelledby="navLanguages navEvents navBlogs navSustain navAbout">
        <div class="navBarGrid">
            <div class="logoImg">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/kantenLogo_white_transparent.webp" alt="Kanten Logo">
                </a>
            </div>
                <ul class="languages"><li id="navLanguages"><?php pll_the_languages() ?></li></ul>
            <ul class="ulNav">
                <li><a id="navEvents" href="#"><?php pll_e("events") ?></a></li>
                <li><a id="navBlogs" href="<?php echo site_url('/blogsview/'); ?>"><?php pll_e("blogs") ?></a></li>
                <li><a id="navSustain" href="<?php echo site_url('/sustainability-initiatives/'); ?>"><?php pll_e("bæredygtighed") ?></a></li>
                <li><a id="navMerch" href="<?php echo site_url('/merchview/'); ?>"><?php pll_e("Merch") ?></a></li>
                <li><a id="navAbout" href="#"><?php pll_e("om") ?></a></li>
            </ul>
        </div>
    </nav>   
<body <?php body_class(); ?>>