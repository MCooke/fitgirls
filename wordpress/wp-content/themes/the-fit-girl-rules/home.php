<?php

/*

Template Name:     Home

*/

?>

<?php get_header(); ?>

<?php if (!get_post_meta($post->ID, 'lolfmkbox_headline_check', true) == 'yes') { ?>

<?php } ?>

<?php // START the loop ?> 

<!-- Home Page Template -->
<body>

  <div id="page" class="hfeed">

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
            <img src="http://www.thefitgirlrules.com/images/banners/home-main-banner-wide-1.jpg">
          </li>
          <li>
            <img src="http://www.thefitgirlrules.com/images/banners/home-main-banner-wide-2.jpg">
          </li>
          <li>
            <img src="http://www.thefitgirlrules.com/images/banners/home-main-banner-wide-3.jpg">
          </li>
          <li>
            <img src="http://www.thefitgirlrules.com/images/banners/home-main-banner-wide-4.jpg">
          </li>
          <li>
            <img src="http://www.thefitgirlrules.com/images/banners/home-main-banner-wide-5.jpg">
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
                 <div class="col-xs-9">
                   <div class="entry-content">
                    <!-- BEGIN #post -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                      <!-- BEGIN .entry-conent -->
                      <div class="entry-content">
                        <div class="recent-posts">                    
                          <?php $the_query = new WP_Query( 'showposts=12' ); ?>
                          <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                            <div class="recent-post">
                              <a href="<?php the_permalink() ?>">
                                <div class="thumbnail"><?php the_post_thumbnail(); ?></div>
                                <h3><?php the_title(); ?></h3>
                              </a>
                            </div>
                          <?php endwhile;?>
                        </div>
                      </div>
                      <!-- END .entry-conent -->
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
            <!-- SnapWidget -->
            <script src="http://snapwidget.com/js/snapwidget.js"></script>
            <iframe src="http://snapwidget.com/p/widget/?id=z2sKUMZXuk&t=851" title="Instagram Widget" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%;"></iframe>
          </div>


        </div>
      </div>
    </body>
    </html>

    <!-- END #page -->

    <?php get_footer(); ?>