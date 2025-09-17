<?php get_header(); ?>
<?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
        
      <section class="blogviewSection">
        <h2><?php pll_e("alle blogindlæg") ?></h2>
          <?php
            $args = array(
              'post_type'      => 'blog',
              'posts_per_page' => -1,
              'lang' => pll_current_language(),
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
            <img src="<?php echo esc_url($blogImage['url'])?>" alt="<?php echo esc_attr($blogImage['alt']); ?>">
          </div>
          <h3><?php echo esc_html($blogTitle); ?></h3>
          <h4><?php echo esc_html($categoryLabel); ?></h4>
          <div class="blogCardDetails">
            <small class="blogAuthor"><?php pll_e("af") ?> <?php echo esc_html($blogAuthor); ?></small>
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


        <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>