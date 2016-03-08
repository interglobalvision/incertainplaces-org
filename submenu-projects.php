	<nav class="thin-col col font-uppercase submenu" id="submenu-level-1">
		<nav class="col-number">4</nav>
		<div class="col-inner">
      <ul>
  			<li><a class="js-open-level-1" data-target="commissions">Commissions</a></li>
  			<li><a class="js-open-level-1" data-target="talks-and-debates">Talks and Debates</a></li>
  			<li><a class="js-open-level-1" data-target="practising-place">Practising Place</a></li>
  		</ul>
		</div>
	</nav>

<!-- 	Commissions Submenu -->
	<nav class="thin-col col submenu submenu-level-2" id="submenu-commissions">
		<div class="col-inner">
  		<ul>
    		<li class="font-uppercase">Current</li>
  		<?php
  			$commissions = get_posts(array(
    			'posts_per_page' => -1,
    			'post_type' => 'projects',
    			'category_name' => 'commissions+current'
  			));
  			$activeyear;
  			$i = 0;
  			foreach ($commissions as $post) {
  				$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'hover-thumb');
  				if ($i === 0) {
            $activeyear = get_the_date('Y');
  /*           echo '<li class="year">' . $activeyear . '</li>'; */
            echo '<li class="year"></li>';
  				} else {
  				  $postyear = get_the_date('Y');
    				if ($activeyear !== $postyear) {
      				$activeyear = $postyear;
              echo '<li class="year">' . $activeyear . '</li>';
    				}
  				}
  				echo '<li>
  						<a class="u-width-100 invert-indent js-tooltip js-ajax-projects js-open-content" data-hover-image="' . $img[0] . '" href="' . get_permalink($post->ID) . '">
  							' . $post->post_title . '
  						</a>
  					</li>';
  				$i++;
  			}
  		?>
  		</ul>
  		<ul>
    		<li class="font-uppercase">Previous</li>
  		<?php
  			$commissions = get_posts(array(
    			'posts_per_page' => -1,
    			'post_type' => 'projects',
    			'category_name' => 'commissions+previous'
  			));
  			$activeyear;
  			$i = 0;
  			foreach ($commissions as $post) {
  				$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'hover-thumb');
  				if ($i === 0) {
            $activeyear = get_the_date('Y');
            echo '<li class="year">' . $activeyear . '</li>';
  				} else {
  				  $postyear = get_the_date('Y');
    				if ($activeyear !== $postyear) {
      				$activeyear = $postyear;
              echo '<li class="year">' . $activeyear . '</li>';
    				}
  				}
  				echo '<li>
  						<a class="u-width-100 invert-indent js-tooltip js-ajax-projects js-open-content" data-hover-image="' . $img[0] . '" href="' . get_permalink($post->ID) . '">
  							' . $post->post_title . '
  						</a>
  					</li>';
  				$i++;
  			}
  		?>
  		</ul>
		</div>
	</nav>

<!-- 	Talks & Debates Submenu -->
	<nav class="thin-col col submenu submenu-level-2" id="submenu-talks-and-debates">
		<div class="col-inner">
  		<ul>
  		<?php
  			$commissions = get_posts(array(
    			'posts_per_page' => -1,
    			'post_type' => 'projects',
    			'category_name' => 'talks-and-debates'
  			));
  			$activeyear = '';
  			$i = 0;
  			foreach ($commissions as $post) {
  				$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'hover-thumb');
  				if ($i === 0) {
            $activeyear = get_the_date('Y');
            echo '<li class="year">' . $activeyear . '</li>';
  				} else {
  				  $postyear = get_the_date('Y');
    				if ($activeyear !== $postyear) {
      				$activeyear = $postyear;
              echo '<li class="year">' . $activeyear . '</li>';
    				}
  				}
  				echo '<li>
  						<a class="u-width-100 invert-indent js-tooltip js-ajax-projects js-open-content" data-hover-image="' . $img[0] . '" href="' . get_permalink($post->ID) . '">
  							' . $post->post_title . '
  						</a>
  					</li>';
  				$i++;
  			}
  		?>
  		</ul>
		</div>
	</nav>

<!-- 	Practising Place Submenu -->
	<nav class="thin-col col font-uppercase submenu submenu-level-2" id="submenu-practising-place">
		<div class="col-inner">
      <ul>
        <li><a class="js-ajax-projects" href="<?php echo home_url('practicing-place/'); ?>">About</a></li>
  			<li>
  				<a class="js-open-level-2 u-width-100" data-target="practising-place-event">
  					Events
  				</a>
  			</li>
  			<li>
  				<a class="js-open-level-2 u-width-100" data-target="practising-place-critical-writing">
  					Critical Writing
  				</a>
  			</li>
  		</ul>
		</div>
	</nav>

	<nav class="thin-col col submenu submenu-level-3" id="submenu-practising-place-event">
		<div class="col-inner">
  		<ul>
  		<?php
  			$events = get_posts('posts_per_page=-1&post_type=projects&category_name=event');
  			foreach ($events as $post) {
  				$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'hover-thumb');
  				echo '<li>
  						<a class="u-width-100 invert-indent js-tooltip js-ajax-projects js-open-content" data-hover-image="' . $img[0] . '" href="' . get_permalink($post->ID) . '">
  							' . $post->post_title . '
  						</a>
  					</li>';
  			}
  		?>
  		</ul>
		</div>
	</nav>

	<nav class="thin-col col submenu submenu-level-3" id="submenu-practising-place-critical-writing">
		<div class="col-inner">
  		<ul>
  		<?php
  			$critical_writing = get_posts('posts_per_page=-1&post_type=projects&category_name=critical-writing');
  			foreach ($critical_writing as $post) {
  				$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'hover-thumb');
  				echo '<li>
  						<a class="u-width-100 invert-indent js-tooltip js-ajax-projects js-open-content" data-hover-image="' . $img[0] . '" href="' . get_permalink($post->ID) . '">
  							' . $post->post_title . '
  						</a>
  					</li>';
  			}
  		?>
  		</ul>
		</div>
	</nav>