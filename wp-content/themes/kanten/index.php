<?php get_header(); ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>

    <div class="container">
      
      <!-- Hero -->
      <section class="heroSection">
        <?php $heroImage = get_field('hero_image'); ?>
        <div class="heroImageContainer">
          <?php echo wp_get_attachment_image($heroImage['ID'], 'hero'); ?>
        </div>
      </section>
      
      <!-- Hidden header -->
      <section class="heroTextSection">
        <h1 class="h1Hidden">
          Kanten Esbjerg
        </h1>
      </section>

      <!-- Testimonials -->
      <section class="testimonySection" role="main">
        <h2 tabindex="0" id="welcomeKanten" aria-labelledby="welcomeKanten testimonyHeading"><?php pll_e("Velkommen til kanten!"); ?></h2>
        <?php
          $args = ['post_type' => 'testimony','posts_per_page' => 3];
          $loop = new WP_Query($args);
          if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
              $testimonyImage = get_field('testimony_image');
              $testimonyGiver = get_the_title();
              $testimonyText  = get_field('testimony_text');
        ?>
          <article class="testimonyCard">
            <div class="testimonyImageContainer">
              <img src="<?php echo esc_url($testimonyImage['url']); ?>" alt="<?php echo esc_attr($testimonyImage['alt']); ?>" />
            </div>
            <div class="testimonyText">
              <h3 id="testimonyHeader"><?php echo esc_html($testimonyGiver); ?></h3>
              <p><?php echo esc_html($testimonyText); ?></p>
            </div>
          </article>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </section>
    
      <!-- Events -->
      <section class="eventFrontpageSection">
        <h2 id="eventHeading"><?php pll_e("Kommende Events"); ?></h2>
        <?php
          $args = [
            'post_type' => 'event',
            'posts_per_page' => 4,
            'lang' => pll_current_language(),
          ];
          $loop = new WP_Query($args);
          if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
              $eventImage = get_field('event_image');
              $eventTitle = get_the_title();
              $eventText  = get_field('event_card_desc');
              $eventDate  = get_field('event_date');
              $eventPrice = get_field('event_price');
              $eventID = 'eventTitle-' . get_the_ID();
        ?>
       <a href="<?php the_permalink(); ?>" class="eventCardLink" aria-labelledby="eventHeading" ?>
  <article class="eventCard">
    <div class="CardImageContainer">
      <?php echo wp_get_attachment_image($eventImage['ID'], 'event-thumb'); ?>
    </div>

    <h3><?php echo esc_html($eventTitle); ?></h3>

    <div class="CardText"><?php echo wp_kses_post($eventText); ?></div>

    <div class="eventCardBottom">
      <div class="eventCardDate">
        <small class="eventDate"><?php pll_e("dato: "); ?><?php echo esc_html($eventDate); ?></small>
      </div>
      <div class="eventCardPrice">
        <?php if ($eventPrice < 1) : ?>
          <div class="eventPrice"><?php pll_e("gratis"); ?></div>
        <?php else : ?>
          <div class="eventPriceOff"><?php echo $eventPrice; ?>.-</div>
        <?php endif; ?>
      </div>
    </div>
  </article>
</a>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </section>

      <!-- Blog -->
      <section class="blogFrontpageSection">
        <h2 id="blogHeading"><?php pll_e("Seneste blogindlæg"); ?></h2>
        <?php
          $args = [
            'post_type' => 'blog',
            'posts_per_page' => 3,
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
            <h3 id="<?php echo $blogID; ?>"><?php echo esc_html($blogTitle); ?></h3>
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

    </div>

    <!-- Form -->
    <div class="survey-form">
        <?php if (isset($_GET['submitted'])): ?>
            <p class="thank-you">Thanks for your response!</p>
        <?php endif; ?>

        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
            <input type="hidden" name="action" value="handle_form_submission">

            <label>Hvad skal være temaet for vores næste event</label>
            <div class="options">
                <label><input type="radio" name="preferred_theme" value="Thursday"> Rasta</label>
                <label><input type="radio" name="preferred_theme" value="Friday"> Punk</label>
                <label><input type="radio" name="preferred_theme" value="Saturday"> Disco</label>
            </div>

            <label for="feedback">Forslag til andre temaer?</label>
            <textarea name="feedback" id="feedback" rows="4"></textarea>

            <input type="submit" value="Send">
        </form>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>

