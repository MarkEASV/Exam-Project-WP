<?php get_header(); ?>
	<section class="searchResults">
		<div>
			<?php if (have_posts()): ?>
			<h1>Søger efter: <?php echo get_search_query(); ?></h1>
			<ul>
				<?php while (have_posts()): the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php else: ?>
			<h1><?php "Nothing found"; ?></h1>
			<p><?php "We couldn't find anything matching your search – please try again"; ?></p>
		<?php endif; ?>
		</div>
	</section>
<?php get_footer(); ?>