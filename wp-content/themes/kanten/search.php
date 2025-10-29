<?php get_header(); ?>

<section class="searchPage">
  <div class="searchResults">
    <?php if (have_posts()) : ?>
      <h2>
        <?php pll_e("Søger efter:"); ?> 
        <span class="search-query">"<?php echo esc_html(get_search_query()); ?>"</span>
      </h2>

      <ul class="searchResultsList">
        <?php while (have_posts()) : the_post(); ?>
          <li>
            <div class="searchResultsListImage">
              <?php
              if (get_post_type() === 'blog') {
                $blogImage = get_field('blog_image');
                if ($blogImage) {
                  echo wp_get_attachment_image($blogImage['ID'], 'thumbnail', false, ['class' => 'searchResultThumb']);
                }
              } elseif (get_post_type() === 'event') {
                $eventImage = get_field('event_image');
                if ($eventImage) {
                  echo wp_get_attachment_image($eventImage['ID'], 'thumbnail', false, ['class' => 'searchResultThumb']);
                }
              }
              ?>
            </div>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </li>
        <?php endwhile; ?>
      </ul>

    <?php else : ?>
      <h3><?php pll_e("Intet fundet 404"); ?></h3>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
