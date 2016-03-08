<?php get_header(); ?>

	<!-- main content -->

	<section id="main-content" class="wide-col col">
		<nav class="col-number">2</nav>
		<div id="ajax-content" class="col-inner">

		<!-- main posts loop -->
		<section id="posts">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  			<div class="news-date"><?php the_time('d-m-Y'); ?></div>

        <h4 class="font-uppercase"><?php the_title(); ?></h4>

 	  		<?php the_content(); ?>

			</article>

		<?php endwhile; else: ?>
			<div class="thin-col col warning"><?php _e('Sorry, no posts matched your criteria'); ?></div>
		<?php endif; ?>

		<?php if (get_next_posts_link() || get_previous_posts_link()) { ?>
		<!-- post pagination -->
		<nav id="pagination">
		  <?php if ($previous = get_previous_posts_link()) {echo $previous; } ?> <?php if ($next = get_next_posts_link()) {echo $next; } ?>
		</nav>
    <?php } ?>

		<!-- end posts -->
		</section>
		</div>

	<!-- end main-content -->
	</section>

<?php get_footer(); ?>