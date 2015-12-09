<?php

/*

Template Name:     Home

*/

?>

<!-- Home Page Template -->
<body>

<?php get_header(); ?>

<?php if (!get_post_meta($post->ID, 'lolfmkbox_headline_check', true) == 'yes') { ?>

<?php } ?>

<?php function custom_excerpt($new_length = 20, $new_more = '...') {
add_filter('excerpt_length', function () use ($new_length) {
return $new_length;
}, 999);
add_filter('excerpt_more', function () use ($new_more) {
return $new_more;
});
$output = get_the_excerpt();
$output = apply_filters('wptexturize', $output);
$output = apply_filters('convert_chars', $output);
$output = '<p>' . $output . '</p>';
echo $output;
}?> 



  <div id="page" class="noBackground hfeed">

    <?php if (get_post_meta($post->ID, 'lolfmkbox_page_margin_check', true) == 'yes') {
      $lol_page_margin = 'no-margin';
    } else {
      $lol_page_margin = '';
    } ?>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script type="text/javascript">
      $(window).load(function() {
        $('.flexslider').flexslider({
          animation: "slide",
          animationSpeed: 1000,
        });
      });
    </script>

    <div class="home-main-banner-wide">
      <div class="flexslider">
        <ul class="slides">
          <li>
            <img src="http://www.thefitgirlrules.com/wp-content/uploads/2015/11/BANNER-41.jpg">
          </li>
          <li>
            <img src="http://www.thefitgirlrules.com/wp-content/uploads/2015/11/BANNER11.jpg">
          </li>
          <li>
            <img src="http://www.thefitgirlrules.com/wp-content/uploads/2015/11/BANNER21.jpg">
          </li>
        </ul>
      </div>
    </div>

    <div id='content'>
      <div id="main">
        <?php while (have_posts()) : the_post(); ?>
          <!-- BEGIN #content -->
          <div id="content" class="<?php echo $lol_page_margin; ?>" role="main">
            <article>
             <div class="container">
               <div class="row">
                 <div class="col-xs-12 col-sm-8">
                   <div class="entry-content">
                    <!-- BEGIN #post -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                      <!-- BEGIN .entry-conent -->
                      <div class="entry-content">
                        <div class="recent-posts row">                    
                          <?php $the_query = new WP_Query( 'showposts=10' );
                          $i = 1; ?>
                          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                            <?php if ( $i < 5 ) { ?>
                              <div class="recentPost col-xs-12">
                                <a class="row" href="<?php the_permalink() ?>">
                                  <div class="thumbnail col-xs-12"><?php the_post_thumbnail(); ?></div>
                                  <div class="col-xs-12">
	                                  <header class="recentPost_header">
	                                  	<h2 class="recentPost_title"><?php the_title(); ?></h2>
	                                  	<div class="recentPost_meta">
	                                  	<span class="meta-wrap"><?php the_date(); ?></span>
	                                  	</div>
	                                  </header>
                                    <?php custom_excerpt(40, ' See more...') ?>
                                  </div>
                                </a>
                              </div>
                            <?php } ?>
                            <?php if ( $i == 5 || $i == 6 ) { ?>
                              <div class="recentPost col-xs-12 col-sm-6">
                                <a class="row" href="<?php the_permalink() ?>">
                                  <div class="thumbnail col-xs-12"><?php the_post_thumbnail(); ?></div>
                                  <div class="col-xs-12">
	                                  <header class="recentPost_header">
	                                  	<h2 class="recentPost_title"><?php the_title(); ?></h2>
	                                  	<div class="recentPost_meta">
	                                  	<span class="meta-wrap"><?php the_date(); ?></span>
	                                  	</div>
	                                  </header>
                                    <?php custom_excerpt(30, ' See more...') ?>
                                  </div>
                                </a>
                              </div>
                            <?php } ?>
                            <?php if ( $i > 6 ) { ?>
                              <div class="recentPost recentPost-thin col-xs-12">
                                <a class="row" href="<?php the_permalink() ?>">
                                  <div class="thumbnail col-xs-4"><?php the_post_thumbnail(); ?></div>
                                  <div class="col-xs-8">
                                    <header class="recentPost_header">
                                    	<h2 class="recentPost_title"><?php the_title(); ?></h2>
                                    	<div class="recentPost_meta">
                                    	<span class="meta-wrap"><?php the_date(); ?></span>
                                    	</div>
                                    </header>
                                    <?php custom_excerpt(20, ' See more...') ?>
                                  </div>
                                </a>
                              </div>
                            <?php } ?>
                            <?php $i++; ?>
                          <?php endwhile;?>
                        </div>
                      </div>
                      <!-- END .entry-conent -->
                      <a class="showall" href="/blog">SEE ALL POSTS</a>
                    </article>
                    <!-- END #post -->
                  </div>
                  <!-- END #content -->
                </div>
                <!-- END col-9 -->
              <?php endwhile; ?>
              <?php // END the loop ?>

              <!-- BEGIN col-3 -->
              <?php get_sidebar(); ?>
              <!-- END col-3 -->

              <!-- END row -->
            </div>

            <!-- END #main -->
						&nbsp;
						&nbsp;
						<h1 style="text-align: center;"> INSTAGRAM FEED </h2>
            <!-- SnapWidget -->
            <script src="http://snapwidget.com/js/snapwidget.js"></script>
            <div class="container">
            	<iframe src="http://snapwidget.com/p/widget/?id=z2sKUMZXuk&t=851" title="Instagram Widget" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%;"></iframe>
            </div>
        </div>


        </div>
      </div>
    </body>
    </html>

    <!-- END #page -->

    <?php get_footer(); ?>