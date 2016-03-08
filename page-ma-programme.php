<?php get_header(); ?>

	<!-- main content -->

<?php
  global $post;
  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <?php get_template_part('submenu', 'students'); ?>

	<section id="main-content" class="wide-col col">
		<div id="ajax-content" class="col-inner">

			<article <?php post_class('js-content'); ?> id="post-<?php the_ID(); ?>">

	 	  		<?php the_content(); ?>

			</article>

		</div>
	<!-- end main-content -->
	</section>

		<?php endwhile; else: ?>
			<div class="thin-col col warning"><?php _e('Sorry, no posts matched your criteria'); ?></div>
		<?php endif; ?>

<?php get_footer(); ?>