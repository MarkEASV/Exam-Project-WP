<?php get_header(); ?>
<?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
        
      <section class="blogviewSection">
        <h1 tabindex="0"><?php pll_e("alle blogindlæg") ?></h1>
          <?php
          $args = [
            'post_type' => 'blog',
            'posts_per_page' => -1,
            'lang' => pll_current_language(),
          ];
          $loop = new WP_Query($args);
          if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
              $blogImage   = get_field('blog_image');
              $blogTitle   = get_the_title();
              $blogText    = get_field('blog_card_text');
              $blogAuthor  = get_the_author_meta('display_name');
              $blogDate    = get_the_date('d-m-Y');
              $blogCategory = get_field('blog_category');
              $categoryLabel = is_object($blogCategory) ? $blogCategory->name : '';
              $blogID = 'blogTitle-' . get_the_ID();
        ?>
        <a href="<?php the_permalink(); ?>" aria-labelledby="blogHeading">
          <article class="blogCard">
            <div class="CardImageContainer">
              <?php echo wp_get_attachment_image($blogImage['ID'], 'blog-thumb'); ?>
            </div>
            <h2 id="<?php echo $blogID; ?>"><?php echo esc_html($blogTitle); ?></h2>
            <?php if ($categoryLabel): ?>
              <p class="blogCategory"><?php echo esc_html($categoryLabel); ?></p>
            <?php endif; ?>
            <div class="blogCardDetails">
              <small class="blogAuthor"><?php pll_e("af_front"); ?> <?php echo esc_html($blogAuthor); ?></small>
              <small class="blogDate"><?php echo esc_html($blogDate); ?></small>
            </div>
            <p class="CardText"><?php echo wp_kses_post($blogText); ?></p>
          </article>
        </a>
        <?php endwhile; endif; wp_reset_postdata(); ?>
              


      </section>


        <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>