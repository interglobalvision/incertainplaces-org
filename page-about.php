<?php get_header(); ?>

	<!-- main content -->

	<section id="main-content" class="wide-col col">
		<nav class="col-number">1</nav>
		<div id="ajax-content" class="col-inner">

		<!-- main posts loop -->
		<section id="posts">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
  		$meta = get_post_meta($post->ID);
		?>

			<article <?php post_class('js-content'); ?> id="post-<?php the_ID(); ?>">

	 	  		<?php the_content(); ?>

          <!-- Begin MailChimp Signup Form -->
          <div id="mc_embed_signup">
            <form action="//incertainplaces.us2.list-manage.com/subscribe/post?u=671025cbafacc6b60f19b86c8&amp;id=940a1f1e1a" method="get" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">

            <div class="mc-field-group">
            	<label for="mce-EMAIL">Enter your e-mail here to join our mailing list:</label><input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
            </div>
                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;"><input type="text" name="b_671025cbafacc6b60f19b86c8_940a1f1e1a" tabindex="-1" value=""></div>
                </div>
            </form>
            <div id="mc-embedded-subscribe-thanks">Your email has been updated</div>
          </div>
          <!--End mc_embed_signup-->

          <div id="about-logos">
            <?php
            	if (!empty($meta['_cmb_about_logos'][0])) {
                echo wpautop($meta['_cmb_about_logos'][0]);
            	} ?>
          </div>

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