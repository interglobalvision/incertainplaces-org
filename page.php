<?php
get_header();
if (is_page('Practicing Place')) {
  get_template_part('submenu', 'projects');
}
?>

	<!-- main content -->
	<section id="main-content" class="wide-col col">
		<nav class="col-number">2</nav>

		<!-- main posts loop -->
		<section id="posts">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('js-content'); ?> id="post-<?php the_ID(); ?>">

        <h4 class="font-uppercase"><?php the_title(); ?></h4>

 	  		<?php the_content(); ?>

			</article>

		<?php endwhile; else: ?>
			<div class="thin-col col warning"><?php _e('Sorry, no posts matched your criteria'); ?></div>
		<?php endif; ?>

		<!-- end posts -->
		</section>

	<!-- end main-content -->
	</section>

<?php get_footer(); ?>