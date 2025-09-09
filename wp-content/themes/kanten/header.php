<?php wp_head(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('Kanten'); ?></title>
    <?php wp_head(); ?>
</head>
    <nav class="navBar">
    <!-- <img src="" alt=""> -->
        <div class="navBarGrid">
            <div class="logoImg">
                <p>NIGGA INC</p>
            </div>
            <ul class="ulNav">
                <li><a href="#">Events</a></li>
                <li><a href="<?php echo site_url('/blog/'); ?>">Blogs</a></li>
                <li><a href="<?php echo site_url('/sustainability-initiatives/'); ?>">Bæredygtighed</a></li>
                <li><a href="#">Om</a></li>
                <li><a href="#">Støtte</a></li>
            </ul>
        </div>
    </nav>   
<body <?php body_class(); ?>>