<?php get_header(); ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>

    <div class="container">

    <!--
        * lav en field group til frontpage der indeholder:
         - et image field med sluggen hero_image
    -->
        <section class="heroSection">
            <?php 
                $heroImage = get_field('hero_image');
            ?>
            <div class="heroImageContainer">
                <img src="<?php echo esc_url($heroImage['url']); ?>" alt="<?php echo esc_attr($heroImage['alt']); ?>" />
            </div>

        </section>



    <!-- 
    * lav en post type med sluggen testimony 
    * lav en field group til testimonials der indeholder:
     - et image field med sluggen testimony_image
     - et text area field med sluggen testimony_text
    -->

      <section class="testimonySection">
        <?php
          $args = array(
            'post_type'      => 'testimony',
            'posts_per_page' => 3,
          );

          $loop = new WP_Query($args);

          if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();

              $testimonyImage = get_field('testimony_image');
              $testimonyGiver = get_the_title();
              $testimonyText  = get_field('testimony_text');
        ?>
              <div class="testimonyCard">
                <div class="testimonyImageContainer">
                  <img src="<?php echo esc_url($testimonyImage['url']); ?>" alt="<?php echo esc_attr($testimonyImage['alt']); ?>" />
                </div>
                <div class="testimonyText">
                  <h3><?php echo esc_html($testimonyGiver); ?></h3>
                  <p><?php echo esc_html($testimonyText); ?></p>
                </div>
              </div>
        <?php
            endwhile;
          endif;
          wp_reset_postdata();
        ?>
      </section>
    
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
