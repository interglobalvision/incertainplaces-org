<?php get_header(); ?>

	<!-- main content -->

	<section id="main-content" class="wide-col col">
		<nav class="col-number">6</nav>
		<div id="ajax-content" class="col-inner">

		<!-- main posts loop -->
		<section id="posts">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
      $meta = get_post_meta($post->ID);
		?>

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<a href="<?php the_permalink() ?>">
			  <h4 class="font-uppercase"><?php the_title(); ?></h4>
			</a>

 	  		<?php the_content(); ?>

 	  		<div class="purchase">

   	  		<?php
   	  			if (!empty($meta['_cmb_price'][0])) {
     	  			echo '<span>PRICE £' . $meta['_cmb_price'][0] . '</span>';
   	  			}
   	  			if ($meta['_cmb_paypal'][0]) { ?>

             <form class="shop-form" action="https://www.paypal.com/cgi-bin/webscr" method="post">

								<input type="hidden" name="business" value="MLE4EM9XYT9M2">
								<input type="hidden" name="cmd" value="_xclick">

								<input type="hidden" name="item_name" value="<?php echo $post->post_title; ?>">
								<input type="hidden" name="amount" value="<?php echo $meta['_cmb_price'][0]; ?>">
								<input type="hidden" name="currency_code" value="GBP">

								<input type="submit" class="buy-button" value="Buy" border="0" alt="Buy with PayPal">
								<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

							</form>

            <?php
   	  			}
   	  			if (!empty($meta['_cmb_amazon'][0])) {
     	  			echo '<a href="' . $meta['_cmb_amazon'][0] . '">Buy on Amazon</a>';
   	  			}
   	  		?>

 	  		</div>

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