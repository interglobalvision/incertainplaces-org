	<nav class="thin-col col submenu" id="submenu-level-1">
		<nav class="col-number">3</nav>
		<div class="col-inner">
      <ul>
  			<?php
  				$artists = get_posts('post_type=artists&posts_per_page=-1&order=ASC&orderby=title');
  				foreach ($artists as $post) {
  					$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'hover-thumb');
  					echo '<li class="" data-target="' . get_the_permalink($post->ID) . '">
  							<a class="u-width-100 js-tooltip js-ajax-artists js-open-content" data-hover-image="' . $img[0] . '" href="' . get_permalink($post->ID) . '">
  							' . $post->post_title . '
  							</a>
  						</li>';
  				}
  			?>
  		</ul>
		</div>
	</nav>