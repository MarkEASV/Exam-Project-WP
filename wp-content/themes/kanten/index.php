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
    
      <section class="eventFrontpageSection">
        <h2><?php pll_e("Kommende Events")?></h2>
          <?php
            $args = array(
              'post_type'      => 'event',
              'posts_per_page' => 4,
            );

            $loop = new WP_Query($args);

            if ($loop->have_posts()) :
              while ($loop->have_posts()) : $loop->the_post();

                $eventImage = get_field('event_image');
                $eventTitle = get_the_title();
                $eventText = get_field('event_card_desc');
                $eventDate  = get_field('event_date');
                $eventPrice = get_field('event_price');
          ?>
      <a href="<?php the_permalink(); ?>">
        <div class="eventCard">
          <div class="CardImageContainer">
            <img src="<?php echo esc_url($eventImage['url']); ?>" alt="<?php echo esc_attr($eventImage['alt']); ?>" />
          </div>
          <h3><?php echo esc_html($eventTitle); ?></h3>
          <div class="CardText"><?php echo wp_kses_post($eventText); ?></div>
          <div class="eventCardBottom">
            <div class="eventCardDate"><small class="eventDate"><?php pll_e("dato") ?><?php echo esc_html($eventDate); ?></small></div>
            <div class="eventCardPrice">
                <?php if ($eventPrice < 1) : ?>
                  <div class="eventPrice">
                    <h5><?php echo $eventPrice; ?><?php pll_e("gratis") ?></h5>
                  </div>
                  <?php else : ?>
                    <div class="eventPriceOff">
                      <h5><?php echo $eventPrice; ?>.-</h5>
                    </div>
                <?php endif; ?>
            </div>
          </div>
        </div>
      </a>
          <?php
              endwhile;
            endif;
            wp_reset_postdata();
          ?>
      </section>

      <section class="blogFrontpageSection">
        <h2><?php pll_e("seneste blogindlæg") ?></h2>
          <?php
            $args = array(
              'post_type'      => 'blog',
              'posts_per_page' => 3,
              'lang'           => '',
            );

            $loop = new WP_Query($args);

            if ($loop->have_posts()) :
              while ($loop->have_posts()) : $loop->the_post();

                $blogImage = get_field('blog_image');
                $blogTitle = get_the_title();
                $blogText = get_field('blog_card_text');
                $blogAuthor = get_the_author_meta('display_name');
                $blogDate  = get_the_date('d-m-Y');
                $blogCategory = get_field('blog_category');

                        if ($blogCategory) {
                            if (is_object($blogCategory)) {
                            $categoryLabel = $blogCategory->name;
                                                    }
                        }
          ?>
      <a href="<?php the_permalink(); ?>">
        <div class="blogCard">
          <div class="CardImageContainer">
            <img src="<?php echo esc_url($blogImage['url']); ?>" alt="<?php echo esc_attr($blogImage['alt']); ?>" />
          </div>
          <h3><?php echo esc_html($blogTitle); ?></h3>
          <h4><?php echo esc_html($categoryLabel); ?></h4>
          <div class="blogCardDetails">
            <small class="blogAuthor">Af <?php echo esc_html($blogAuthor); ?></small>
            <small class="blogDate"><?php echo esc_html($blogDate); ?></small>
          </div>
          <div class="CardText"><?php echo wp_kses_post($blogText); ?></div>
        </div>
      </a>
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
