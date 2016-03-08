<nav class="thin-col col font-uppercase submenu" id="submenu-level-1">
		<nav class="col-number">5</nav>
		<div class="col-inner">
  		<ul>
  			<li><a class="js-open-content js-open-ma-information" data-target="<?php echo site_url('ma-programme'); ?>">Information</a></li>
  			<li><a class="js-open-level-1" data-target="students">Students</a></li>
  		</ul>
		</div>
	</nav>

	<nav class="thin-col col submenu submenu-level-2" id="submenu-students">
 		<div class="col-inner">
      <h4 class="font-uppercase">Current Students</h4>
  		<ul>
  		<?php
  			$students = get_posts('posts_per_page=-1&post_type=students&category_name=current-students&orderby=title&order=ASC');
  			foreach ($students as $post) {
  				$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'hover-thumb');
  				echo '<li>
  						<a class="u-width-100 js-tooltip inverse-indent js-ajax-students js-open-content" data-hover-image="' . $img[0] . '" href="' . get_permalink($post->ID) . '">
  							' . $post->post_title . '
  						</a>
  					</li>';
  			}
  		?>
  		</ul>
  		<h4 class="font-uppercase">Former Students</h4>
  		<ul>
  		<?php
  			$students = get_posts('posts_per_page=-1&post_type=students&category_name=former-students&orderby=title&order=ASC');
  			foreach ($students as $post) {
  				$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'hover-thumb');
  				echo '<li>
  						<a class="u-width-100 js-tooltip inverse-indent js-ajax-students js-open-content" data-hover-image="' . $img[0] . '" href="' . get_permalink($post->ID) . '">
  							' . $post->post_title . '
  						</a>
  					</li>';
  			}
  			wp_reset_postdata();
  		?>
  		</ul>
 		</div>
	</nav>