<?php get_header(); ?>
    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>


                 <?php
                  $blogImage = get_field('blog_image');
                  $blogTitle = get_the_title();
                  $blogTextFull = get_field('blog_full_text');
                  $blogAuthor = get_the_author_meta('display_name');
                  $blogDate  = get_the_date('d-m-Y');
                  $blogCategory = get_field('blog_category');

                          if ($blogCategory) {
                              if (is_object($blogCategory)) {
                              $categoryLabel = $blogCategory->name;
                                                      }
                          }
            ?>

<section class="articleSite">
        <div>
                <h2> <?php echo esc_html($categoryLabel); ?></h2>
            <div class="articleSiteCategory">
<?php
$tags = get_field('blog_tags');

if (!empty($tags) && is_array($tags)) : ?>
    <div class="articleSiteCategory">
        <?php foreach ($tags as $tag) : ?>
            <span class="articleCategoryBox"><?php echo esc_html($tag->name); ?></span>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
            </div>
        </div>



  <div class="articleImgBox">
    <img src="<?php echo esc_url($blogImage['url']); ?>" alt="<?php echo esc_attr($blogImage['alt']); ?>">
  </div>

        
        <div class="articleSiteSetup">
            <h1><?php echo esc_html($blogTitle); ?></h1>
            <div class="articleAuthorText">
                <div>
                    <p>Skrevet af</p>
                    <p><?php echo esc_html($blogAuthor); ?></p>
                </div>
                <div>
                    <?php echo esc_html($blogDate); ?>
                </div>
            </div>

<div class="blogTextFull">
  <?php echo $blogTextFull; ?>
</div>

            
        </div>

        <div>
      <section class="blogRelatedSection">
        <h2>Andre Blogindlæg</h2>
          <?php
          $blogCategory = get_field('blog_category');

if ($blogCategory && is_object($blogCategory)) {
    $mainCategorySlug = $blogCategory->slug;     
}

            $args = array(
              'post_type'      => 'blog',
              'posts_per_page' => 3,
              'lang' => pll_current_language(),
               'post__not_in' => array(get_the_ID()),
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
          <div class="cardImageContainer">
            <?php  echo wp_get_attachment_image( $blogImage['ID'], 'blog-thumb' ); ?>
          </div>
          <h3><?php echo esc_html($blogTitle); ?></h3>
          <h4><?php echo esc_html($categoryLabel); ?></h4>
          <div class="blogCardDetails">
            <small class="blogAuthor">Af <?php echo esc_html($blogAuthor); ?></small>
            <small class="blogDate"><?php echo esc_html($blogDate); ?></small>
          </div>
          <div class="cardText"><?php echo wp_kses_post($blogText); ?></div>
        </div>
      </a>
          <?php
              endwhile;
            endif;
            wp_reset_postdata();
          ?>
              


      </section>
    </section>

            <?php endwhile; ?>
    <?php endif; ?>
<?php get_footer(); ?>