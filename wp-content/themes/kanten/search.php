<?php get_header(); ?>
	<section class="searchPage">
		<div class="searchResults">
			<?php if (have_posts()): ?>
			<h1>Søger efter: <?php echo get_search_query(); ?></h1>
			<ul class="searchResultsList">
				<?php while (have_posts()): the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php else: ?>
			<h1><?php "Intet fundet 404"; ?></h1>
		<?php endif; ?>
		</div>
	</section>
<?php get_footer(); ?>