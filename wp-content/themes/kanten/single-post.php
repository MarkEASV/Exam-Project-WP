<?php
get_header();
?>

<main class="blog-article">

  <!-- Tags -->
  <?php
  $terms = get_the_terms(get_the_ID(), 'tags'); // replace 'tags' with your taxonomy slug
  if ($terms && !is_wp_error($terms)): ?>
    <div class="tags">
      <?php foreach ($terms as $term): ?>
        <span class="tag"><?php echo esc_html($term->name); ?></span>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <!-- Hero Image -->
  <?php if (get_field('hero_image')): ?>
    <div class="hero-image">
      <img src="<?php the_field('hero_image'); ?>" alt="<?php the_title(); ?>">
    </div>
  <?php endif; ?>

  <main class="blog-article">

  <!-- Tags go here -->
  <?php
  $terms = get_the_terms(get_the_ID(), 'tags'); // replace with your taxonomy slug
  if ( $terms && ! is_wp_error( $terms ) ) : ?>
      <div class="tags">
          <?php foreach ( $terms as $term ) : ?>
              <span class="tag"><?php echo esc_html( $term->name ); ?></span>
          <?php endforeach; ?>
      </div>
  <?php endif; ?>

  <!-- Hero Image -->
  <?php if (get_field('hero_image')): ?>
      <div class="hero-image">
          <img src="<?php the_field('hero_image'); ?>" alt="<?php the_title(); ?>">
      </div>
  <?php endif; ?>

  <!-- Title -->
  <h1><?php the_title(); ?></h1>

  <!-- Event Date -->
  <?php if (get_field('event_date')): ?>
    <p class="event-date"><?php the_field('event_date'); ?></p>
  <?php endif; ?>

  <!-- Author -->
  <div class="author">
    <?php if (get_field('author_image')): ?>
      <img src="<?php the_field('author_image'); ?>" alt="<?php the_field('author_name'); ?>">
    <?php endif; ?>
    <p><?php the_field('author_name'); ?></p>
  </div>

  <!-- Content -->
  <div class="content">
    <?php the_field('content'); ?>
  </div>

  <!-- Comments -->
  <div class="comments">
    <?php
    if ( post_password_required() ) {
        echo '<p>This post is password protected. Enter the password to view comments.</p>';
        return;
    }

    if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                printf( _x( 'One Comment', 'comments title', 'your-textdomain' ) );
            } else {
                printf(
                    _nx(
                        '%1$s Comment',
                        '%1$s Comments',
                        $comments_number,
                        'comments title',
                        'your-textdomain'
                    ),
                    number_format_i18n( $comments_number )
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
            ) );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

    <?php
    comment_form( array(
        'class_form' => 'custom-comment-form',
        'title_reply' => 'Leave a Comment',
        'label_submit' => 'Post Comment',
    ) );
    ?>
  </div>

</main>

<?php
get_footer();
?>
