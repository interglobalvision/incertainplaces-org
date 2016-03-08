</section>

<?php if (is_home()) {

  $slides = get_posts('post_type=home_slide&posts_per_page=5&orderby=rand');
  if ($slides) {
   $i = 0;
   echo '<div id="home-slides">';
   foreach ($slides as $post) {
     $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slide');
     if ($i === 0) {
       echo '<div class="home-slide active" style="background-image: url(' . $img[0] . ')" data-background="' . $img[0] . '">';
     } else {
       echo '<div class="home-slide" data-background="' . $img[0] . '">';
     }
     echo ' <div class="home-slide-text">';
     the_title();
     echo ' </div>';
     echo '</div>';
     $i++;
   }
   echo '</div>';
   echo '<div id="home-click" class="u-pointer"></div>';
  }
} ?>

<img id="tooltip" />

<section id="scripts">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-2.1.1.min.js"><\/script>')</script>
	<?php wp_footer(); ?>
	<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-64635976-1', 'auto');
    ga('send', 'pageview');

  </script>
</section>
</body>
</html>