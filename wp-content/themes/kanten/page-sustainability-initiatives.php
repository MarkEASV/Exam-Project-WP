<?php get_header(); ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <?php 
    $heroImage = get_field('hero_image');
  ?>
<div class="areapic"><?php  echo wp_get_attachment_image( $heroImage['ID'], 'hero' ); ?></div>
        <section class="statisticsSection">
            <div class="titleArea">
                <h2><?php pll_e("Vi sætter fokus på FN’s Verdensmål 5: Ligestilling mellem kønnene.") ?></h2>
                <p><?php pll_e("På Kanten arbejder vi for at skabe en kulturscene, hvor alle har lige muligheder. Musik og kunst kan være med til at åbne øjne og skabe forandring, og derfor har vi valgt at sætte fokus på ligestilling mellem kønnene.") ?></p>
            </div>
<?php
$args = array(
  'post_type'      => 'statistic',
  'posts_per_page' => 3,
);

$loop = new WP_Query($args);
$index = 0;

if ($loop->have_posts()) :
  while ($loop->have_posts()) : $loop->the_post();

    $statisticImage = get_field('statistic_image');
    $statisticText  = get_field('statistic_text');

    // Lige/ulige tjek
    $is_even = $index % 2 == 0;
    $layout_class = $is_even ? 'layout-right' : 'layout-left';
    ?>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class($layout_class); ?>>
      <div class="statistic-wrapper">
        
        <div class="image">
          <?php if ($statisticImage) : ?>
            <img src="<?php echo esc_url($statisticImage['url']); ?>" alt="<?php echo esc_attr($statisticImage['alt']); ?>" />
          <?php endif; ?>
        </div>

        <div class="text">
          <div class="content">
            <?php echo wp_kses_post($statisticText); ?>
          </div>
        </div>

      </div>
    </article>

    <?php
    $index++;
  endwhile;
endif;

wp_reset_postdata();
?>


        </section>

<section class="equalityEventSection">
                <div class="titleArea">
                <h3><?php pll_e("Equality Week Event") ?></h3>
                <p><?php pll_e("Drop det sædvanlige. Kom til Equality Week og oplev en uge med snak, idéer og oplevelser, der faktisk betyder noget. Mød folk, bliv provokeret, bliv inspireret og vær med til at rykke tingene.") ?></p>
            </div>
            <div class="equalityEvent">
                 <?php
            $args = array(
              'post_type'      => 'event',
              'name'           => 'equality-week',
              'posts_per_page' => 1,
              'lang' => pll_current_language(),
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
            <?php  echo wp_get_attachment_image( $eventImage['ID'], 'event-thumb' ); ?>
          </div>
          <h3><?php echo esc_html($eventTitle); ?></h3>
          <div class="CardText"><?php echo wp_kses_post($eventText); ?></div>
          <div class="eventCardBottom">
            <div class="eventCardDate"><small class="eventDate"><?php pll_e("dato: ") ?><?php echo esc_html($eventDate); ?></small></div>
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
            </div>
            </section>

            <section class="equalityInterviewSection">
                <div class="titleArea">
                    <h2><?php pll_e("Interview med Dansk Kvindesamfund") ?></h1>
                    <p><?php pll_e("I forbindelse med vores ligestillingsuge har vi talt med en repræsentant fra Dansk Kvindesamfund. Interviewet giver et indblik i de udfordringer og muligheder, der præger arbejdet med ligestilling i erhvervslivet, og sætter fokus på, hvorfor temaet også er vigtigt på scenen hos os på Kanten.") ?></p>
                </div>
                   <?php
            $args = array(
              'post_type'      => 'interview',
              'posts_per_page' => 3,
              'lang' => pll_current_language(),
            );

            $loop = new WP_Query($args);

            if ($loop->have_posts()) :
              while ($loop->have_posts()) : $loop->the_post();

                $interviewQuestion = get_field('interview_question');
                $interviewAnswer = get_field('interview_answer');
          ?>
            <div class="interviewQuestion">
                <p><?php echo wp_kses_post($interviewQuestion); ?></p>
            </div>
            <div class="interviewAnswer">
                <p><?php echo wp_kses_post($interviewAnswer); ?></p>
            </div>
          <?php
              endwhile;
            endif;
            wp_reset_postdata();
          ?>
            </section>

            <div class="titleArea">
                        <h2><?php pll_e("Blogindlæg om ligestilling") ?></h2>
                    </div>
 <section class="blogSustainSection">
          <?php
            $args = array(
              'post_type'      => 'blog',
              'posts_per_page' => 3,
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
            <?php  echo wp_get_attachment_image( $blogImage['ID'], 'blog-thumb' ); ?>
          </div>
          <h3><?php echo esc_html($blogTitle); ?></h3>
          <h4><?php echo esc_html($categoryLabel); ?></h4>
          <div class="blogCardDetails">
            <small class="blogAuthor"><?php pll_e("af_front")?> <?php echo esc_html($blogAuthor); ?></small>
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