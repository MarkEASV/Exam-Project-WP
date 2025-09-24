<?php get_header(); ?>
<?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
        
      <section class="blogviewSection">
        <h2><?php pll_e("Alt Merch") ?></h2>
          <?php
            $args = array(
              'post_type'      => 'merch-item',
              'posts_per_page' => -1,
              'lang' => pll_current_language(),
            );

            $loop = new WP_Query($args);

            if ($loop->have_posts()) :
              while ($loop->have_posts()) : $loop->the_post();
                
                $merchImage = get_field('merch_image_main');
                $merchTitle = get_the_title();
                $merchPrice = get_field('merch_item_price');
                $merchCategory = get_field('merch_item_category');

                        if ($merchCategory) {
                            if (is_object($merchCategory)) {
                            $categoryLabel = $merchCategory->name;
                                                    }
                        }
          ?>
      <a href="<?php the_permalink(); ?>">
        
        <div class="merchCard">
          <div class="merchCardImageContainer">
            <img src="<?php echo esc_url($merchImage['url'])?>" alt="<?php echo esc_attr($merchImage['alt']); ?>">
          </div>
          <h4><?php echo esc_html($categoryLabel); ?></h4>
          <h3><?php echo esc_html($merchTitle); ?></h3>
          <div class="merchPriceContainer"><p>kr <?php echo esc_html($merchPrice); ?>,-</p></div>

  
        </div>
      </a>
          <?php
              endwhile;
            endif;
            wp_reset_postdata();
          ?>
              


      </section>


        <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>