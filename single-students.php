<?php get_header(); ?>

  <?php get_template_part('submenu', 'students'); ?>

	<!-- main content -->

	<section id="main-content" class="wide-col col">
		<div id="ajax-content" class="col-inner">

		<!-- main posts loop -->
		<section id="posts">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('js-content'); ?> id="post-<?php the_ID(); ?>">

			<a href="<?php the_permalink() ?>">
			  <h4 class="font-uppercase"><?php the_title(); ?></h4>
			</a>

 	  		<?php the_content(); ?>

			</article>

		<?php endwhile; else: ?>
			<div class="thin-col col warning"><?php _e('Sorry, no posts matched your criteria'); ?></div>
		<?php endif; ?>

		<!-- end posts -->
		</section>

		</div>
	<!-- end main-content -->
	</section>

<?php get_footer(); ?>