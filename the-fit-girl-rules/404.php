<?php

/*

Template Name:     404

*/

?>

<?php get_header(); ?>

<?php if (!get_post_meta($post->ID, 'lolfmkbox_headline_check', true) == 'yes') { ?>



	<h1><?php the_title(); ?></h1>

<?php } ?>

<!-- BEGIN #page -->
<div id="page" class="hfeed">

<!-- BEGIN #main -->
<div id="main" class="container">

	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-12">
	
			<!-- BEGIN #content -->
			<div id="content" role="main">
				
					<div class="entry-content">
						
						<div class="page-not-found">
                                                    <h1 style="text-align: center">Page Not Found</h1>
                                                    <div class="clear-space" style="height: 30px"></div>
                                                    <a href="http://www.thefitgirlrules.com"><div class="button">Return To Home</div></a>
                                                    <div class="clear-space" style="height: 200px"></div>
                                                </div>

					</div>

			</div>
			<!-- END #content -->

		</div>
		<!-- END col-12 -->
	<!-- END row -->
	</div>

<!-- END #main -->
</div>

</div>
<!-- END #page -->

<?php get_footer(); ?>