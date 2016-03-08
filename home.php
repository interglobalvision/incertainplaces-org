<?php
	get_header();
	global $post;
?>

<!-- About -->
	<nav class="thin-col col home-drawer" id="home-about">
		<nav class="col-number">1</nav>
		<div class="col-inner">
		<?php
			$about = get_page_by_title('About');
      $img = wp_get_attachment_image_src(get_post_thumbnail_id($about->ID), 'col-thin');
      $meta = get_post_meta($about->ID);
      echo '<p><img src="' . $img[0] . '" alt="About ICP"/></p>';
      if(!empty($meta['_cmb_about_home'][0])) {
        echo '<p>' . wpautop($meta['_cmb_about_home'][0]) . '</p>';
      }
		?>
		<a class="indent-link" href="<?php echo site_url('about/'); ?>">Continue reading &rarr;</a>
		</div>
	</nav>

<!--  News -->
	<nav class="thin-col col home-drawer"  id="home-news">
		<nav class="col-number">2</nav>
		<div class="col-inner">
		<?php
			$news = get_posts('posts_per_page=2');
			foreach ($news as $post) {
				setup_postdata($post);
        $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'col-thin');
			?>
			<div class="home-news">
  			<a href="<?php the_permalink(); ?>">
    		  <div class="home-news-date">
    				<?php the_time('d-m-Y'); ?>
    		  </div>
          <h4 class="font-uppercase">
    				<?php the_title(); ?>
    		  </h4>
  			</a>
  		  <?php
    		  if(!empty($img)) {
      		  echo '<p><a href="' . get_the_permalink() . '"><img src="' . $img[0] . '" /></a></p>';
    		  }
  		  ?>
  		  <div>
  				<?php the_excerpt(); ?>
          <a class="indent-link" href="<?php the_permalink(); ?>">Continue reading &rarr;</a>
  		  </div>
			</div>
		<?php
			}
		?>
		<a class="indent-link" href="<?php echo site_url('category/news/'); ?>">More News &rarr;</a>
		</div>
	</nav>

<!-- Artists -->
	<nav class="thin-col col home-drawer" id="home-artists">
		<nav class="col-number">3</nav>
		<div class="col-inner">
		<ul>
			<?php
				$artists = get_posts('post_type=artists&posts_per_page=-1&order=ASC&orderby=title');
				foreach ($artists as $post) {
				  $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'hover-thumb');
					echo '<li class="" data-target="' . get_the_permalink($post->ID) . '">
					        <a class="u-width-100 js-tooltip" data-hover-image="' . $img[0] . '" href="' . get_the_permalink($post->ID) . '">' . $post->post_title . '</a>
                </li>';
				}
			?>
		</ul>
		</div>
	</nav>

<!-- Projects -->
	<nav class="thin-col col home-drawer" id="home-projects">
		<nav class="col-number">4</nav>
		<div class="col-inner">
		<h4 class="font-uppercase"><a href="<?php echo site_url('projects/#!/commissions'); ?>">Commissions</a></h4>
			<div class="indent">
			<?php
				$commission = get_posts('posts_per_page=1&post_type=projects&category_name=commissions');
				setup_postdata( $commission[0] );
				$img = wp_get_attachment_image_src(get_post_thumbnail_id($commission[0]->ID), 'col-thin');
				echo '<a href="' . get_the_permalink($commission[0]->ID) . '">';
        echo '<img class="home-post-thumb" src="' . $img[0] . '" alt="' . $commission[0]->post_title . '"/>';
				echo '<h4>' . $commission[0]->post_title . '</h4>';
				echo '</a>';				wp_reset_postdata();
			?>
			  <a class="indent-link" href="<?php echo site_url('projects/#!/commissions'); ?>">More Commissions &rarr;</a>
			</div>

		<h4 class="font-uppercase"><a href="<?php echo site_url('projects/#!/talks-and-debates'); ?>">Talks and Debates</a></h4>
			<div class="indent">
			<?php
				$talksanddebates = get_posts('posts_per_page=1&post_type=projects&category_name=talks-and-debates');
				setup_postdata( $talksanddebates[0] );
				$img = wp_get_attachment_image_src(get_post_thumbnail_id($talksanddebates[0]->ID), 'col-thin');
				echo '<a href="' . get_the_permalink($talksanddebates[0]->ID) . '">';
        echo '<img class="home-post-thumb" src="' . $img[0] . '" alt="' . $talksanddebates[0]->post_title . '"/>';
				echo '<h4>' . $talksanddebates[0]->post_title . '</h4>';
				echo '</a>';
				wp_reset_postdata();
			?>
			  <a class="indent-link" href="<?php echo site_url('projects/#!/talks-and-debates'); ?>">More Talks and Debates &rarr;</a>
			</div>

		<h4 class="font-uppercase"><a href="<?php echo site_url('projects/#!/practising-place'); ?>">Practising Place</a></h4>
			<div class="indent">
			<?php
				$practisingplace = get_posts('posts_per_page=1&post_type=projects&category_name=event');
				setup_postdata( $practisingplace[0] );
/* 				$practisingplace = get_page_by_title('Practicing Place'); */
				$img = wp_get_attachment_image_src(get_post_thumbnail_id($practisingplace[0]->ID), 'col-thin');
				echo '<a href="' . get_the_permalink($practisingplace[0]->ID) . '">';
				if (!empty($img)) {
          echo '<img class="home-post-thumb" src="' . $img[0] . '" alt="' . $practisingplace[0]->post_title . '"/>';
        }
				echo '<h4>' . $practisingplace[0]->post_title . '</h4>';
				echo '</a>';
				wp_reset_postdata();
			?>
			  <a class="indent-link" href="<?php echo site_url('projects/#!/practising-place'); ?>">More Practising Place &rarr;</a>
			</div>
		</div>
	</nav>

<!-- MA -->
	<nav class="thin-col col home-drawer" id="home-ma-programme">
		<nav class="col-number">5</nav>
		<div class="col-inner">
          <?php
            $ma = get_page_by_title('MA Programme');
            $meta = get_post_meta($ma->ID);
            if(!empty($meta['_cmb_about_title'][0])) {
              echo '<h4>' . $meta['_cmb_about_title'][0] . '</h4>';
            }
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($ma->ID), 'col-thin');
            echo '<p><img src="' . $img[0] . '" /></p>';
            if(!empty($meta['_cmb_about_home'][0])) {
              echo wpautop($meta['_cmb_about_home'][0]);
            }
          ?>
          <a class="indent-link" href="<?php echo home_url('ma-programme/'); ?>">More information &rarr;</a>
				<ul>
					<li><a class="indent-link font-uppercase" href="<?php echo home_url('ma-programme/#!/students'); ?>">Students</a></li>
				</ul>
		</div>
	</nav>

<!-- Shop -->
	<nav class="thin-col col home-drawer" id="home-shop">
		<nav class="col-number">6</nav>
		<div class="col-inner">
		<ul>
		<?php
  		$shopitems = get_posts('post_type=shop&posts_per_page=3');
  		foreach ($shopitems as $post) {
    		$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'col-thin');
    		echo '<li class="" data-target="' . get_the_permalink($post->ID) . '">';
				echo '<a href="' . get_the_permalink($post->ID) . '">';
				echo '<h4>' . $post->post_title . '</h4>';
        echo '<img class="home-post-thumb" src="' . $img[0] . '" alt="' . $post->post_title . '"/>';
				echo '</a></li>';
  		}
  		?>
		</ul>
		<a class="indent-link" href="<?php echo site_url('shop/'); ?>">Shop Here &rarr;</a>
		</div>
	</nav>

<?php get_footer(); ?>