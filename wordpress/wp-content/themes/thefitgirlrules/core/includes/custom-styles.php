<?php
/**
 * Lollum
 * 
 * Custom styles function
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

/**
 * Custom styles
 */

add_action('wp_head', 'lollum_print_custom_styles');
if (!function_exists('lollum_print_custom_styles')) {
	function lollum_print_custom_styles() { ?>

	<style type="text/css">

	<?php if (get_option('lol_bg_image_check') == 'true') { // check bg body ?>
		<?php if (get_option('lol_background_img_type') == 'Default image') {
			$default_bg = get_option('lol_default_image_bg');
			$default_bg = strtolower(str_replace(' ', '_', $default_bg)); ?>

			body {
				background-image: url(<?php echo LOLLUMCORE_URI . 'admin/images/backgrounds/' . $default_bg . '.png'; ?>);
				background-repeat: repeat;
			}

		<?php } elseif (get_option('lol_custom_image_bg')) { ?>
			body {
			background-image: url(<?php echo get_option('lol_custom_image_bg');?>);
			background-repeat: <?php echo get_option('lol_custom_image_bg_repeat'); ?>;
			<?php if (get_option('lol_custom_image_bg_attachment') == 'true') { ?>
				background-attachment: fixed;
			<?php } ?>
			<?php if (get_option('lol_custom_image_bg_cover') == 'true') { ?>
				background-size: cover;
			<?php } ?>
			}
		<?php } ?>
	<?php } ?>
	
	body {
		background-color: <?php echo get_option('lol_body_bg_color');?>;
	}

	/* first accent color */

	.crumbs a:hover,
	#content .entry-header a:hover,
	#content .entry-content a,
	#content .entry-summary a,
	#content .footer-meta .meta-tags-wrap a:hover,
	#content .format-quote .quote-caption,
	#content .format-quote .quote-caption a,
	#content .format-chat cite,
	#content .format-status .entry-status h3,
	#content .lol-love-wrap a:hover, #content .lol-love-wrap a.loved,
	#content .page-row .lol-love-wrap a:hover,
	#content .page-row .lol-love-wrap a.loved,
	#content .about-author .bio-title span,
	#content blockquote:before,
	#comments .comment-content a,
	#comments .commentlist .comment-meta a:hover,
	#comments .comment-awaiting-moderation,
	#comments .nocomments a:hover,
	#comments .nopassword a:hover,
	#comments .comment-logged-in a:hover,
	#comments .cancel-comment-reply a:hover,
	#comments .pingback a,
	#respond .comment-must-logged a:hover,
	#content .page-row a,
	#content .lol-item-service-column h3 a:hover,
	#content .lol-item-mini-service-column .more:hover,
	#content .lol-item-block-banner h3 span,
	#content .lol-item-block-banner-alt h3 span,
	#content .post-item .post-meta h3 a:hover,
	#content .lol-item-blog-list .entry-meta .entry-categories,
	#content .lol-item-blog-list .entry-meta .entry-categories a,
	#content .lol-item-blog-list .entry-meta .entry-title a:hover,
	#content .lol-item-portfolio-list .entry-meta .entry-categories a:hover,
	#content .lol-item-portfolio-list .entry-meta .entry-title a,
	#content .lol-item-member .meta-member .member-name span,
	#content #lol-faq-topics li a,
	#content .back-faqs,
	#content .job-list h4 a:hover,
	#content .lol-item-testimonial-full h3 span,
	#content .lol-item-testimonial-full h3:after,
	#content .lol-item-testimonial-full .testimonial-meta cite,
	#content .lol-item-testimonial-full .testimonial-meta .sep,
	#content .lol-item-info .vcard a:hover,
	#content .lol-item-info .vcard .fa,
	#content .lol-item-call-to-action h3 span,
	#content .progress-number .fa,
	#content .portfolio-item .portfolio-meta .project-categories a:hover,
	#content .portfolio-item .portfolio-meta h3 a,
	.single-lolfmk-portfolio #content .project-details a,
	#sidebar .widget a,
	#sidebar .lol-love-wrap a:hover, #sidebar .lol-love-wrap a.loved,
	#sidebar .lol_widget_twitter .timestamp a:hover,
	#sidebar .lol-posts-widget .entry-meta .entry-categories,
	#sidebar .lol-posts-widget .entry-meta .entry-title a:hover,
	#sidebar .lol-projects-widget .entry-meta .entry-categories,
	#sidebar .lol-projects-widget .entry-meta .entry-title a:hover,
	#sidebar .info_widget .vcard a:hover,
	#sidebar .info_widget .vcard .fa ,
	#footer .widget a:hover,
	#footer .lol-love-wrap a:hover, #footer .lol-love-wrap a.loved,
	#footer .lol_widget_twitter .timestamp a:hover,
	#footer .lol-posts-widget .entry-meta .entry-categories,
	#footer .lol-posts-widget .entry-meta .entry-title a:hover,
	#footer .lol-projects-widget .entry-meta .entry-categories,
	#footer .lol-projects-widget .entry-meta .entry-title a:hover,
	#footer .info_widget .vcard a:hover,
	#footer-bottom a:hover,
	#content .price-item .price-name,
	#page-title-wrap .page-title h1 span {
		color: <?php echo get_option('lol_first_ac_color');?>;
	}
	#content .lol-item-service-column .service-icon,
	#content .lol-item-mini-service-column .mini-service-icon,
	#content .post-item .post-mask .post-link,
	#content .portfolio-item .portfolio-mask .portfolio-link,
	#content .lol-skill .lol-bar,
	#content .price-item.popular-yes .price-name,
	#content .price-item.popular-yes .price-btn .lol-button,
	#back-top:hover,
	#content .price-item .price-btn .lol-button:hover {
		background-color: <?php echo get_option('lol_first_ac_color');?>;
	}
	#content .lol-item-service-column .service-icon:after {
		border-top: 8px solid <?php echo get_option('lol_first_ac_color');?>;
	}
	#content .lol-item-member .meta-member .member-links li a:hover {
		background-color: <?php echo get_option('lol_first_ac_color');?>;
	}
	#content .lol-item-testimonial-full.light .flexslider.flex-testimonial .flex-direction-nav a:hover,
	#content .lol-item-testimonial-full.dark .flexslider.flex-testimonial .flex-direction-nav a:hover {
		border-color: <?php echo get_option('lol_first_ac_color');?>;
		background-color: <?php echo get_option('lol_first_ac_color');?>;
	}

	/* third accent color */

	#content .sticky .post-wrap:after {
		border-bottom: 50px solid <?php echo get_option('lol_third_ac_color');?>;
	}
	#content .format-quote .entry-content,
	#content .about-author,
	#content .wp-caption-text,
	#content .gallery-caption,
	#content .wp-caption-dd,
	#content .post-item .post-mask:after,
	#content .lol-item-blog-list .entry-thumbnail.no-thumb,
	#content .lol-item-portfolio-list .entry-thumbnail.no-thumb,
	#content .lol-item-member .meta-member,
	#content .lol-item-image-text .image-mask:after,
	#content .lol-item-image-text .image-mask h3,
	#content .portfolio-item .portfolio-mask:after,
	#sidebar .lol-posts-widget .entry-thumbnail.no-thumb,
	#sidebar .lol-projects-widget .entry-thumbnail.no-thumb,
	#footer .lol-posts-widget .entry-thumbnail.no-thumb,
	#footer .lol-projects-widget .entry-thumbnail.no-thumb,
	#content .price-item.popular-yes .price-btn .lol-button:hover,
	.flexslider .flex-direction-nav a,
	#content .price-item .price-btn .lol-button {
		background-color: <?php echo get_option('lol_third_ac_color');?>;
	}
	#content .format-status .entry-status {
	}
	#content .lol-item-text-banner-wrap {
	}

	/* bg preloader color */

	.js #splash,
	.js #bgsplash {
		background-color: <?php echo get_option('lol_splash_bg');?>;
	}

	/* first button color */

	#content .btn1 {
		color: <?php echo get_option('lol_first_btn_color');?>;
	}
	#content .btn1:hover,
	#content .btn2:hover,
	#content .btn3 {
		background-color: <?php echo get_option('lol_first_btn_color');?>;
	}
	#content .lol-item-block-banner.light .lol-button-block:hover,
	#content .lol-item-block-banner.dark .lol-button-block:hover,
	#content .lol-item-call-to-action.light .lol-button-block:hover,
	#content .lol-item-call-to-action.dark .lol-button-block:hover {
		background-color: <?php echo get_option('lol_first_ac_color');?>;
	}

	/* second button color */

	button,
	input[type="submit"],
	.lol-button,
	#content .lol-button,
	#content .page-row .lol-button,
	#content .entry-content .more-link,
	#content .pagelink a:hover,
	#comments #comment-nav a:hover,
	#content .pagination a:hover,
	#content .pagination .current:hover,
	#content .pagination .current,
	#content .portfolio-tabs li a,
	#content .faqs-tabs li a {
		color: <?php echo get_option('lol_second_btn_color');?>;
	}
	#content .footer-meta .social-meta a:hover,
	.single-lolfmk-portfolio #content .projects-navigation-wrap .projects-navigation a:hover,
	.single-lolfmk-portfolio #content .projects-navigation-wrap .projects-links .social-meta a:hover,
	#sidebar .widget_tag_cloud a:hover,
	#footer .widget_tag_cloud a:hover,
	.single-attachment #content #image-navigation a:hover {
		color: <?php echo get_option('lol_second_btn_color');?>!important;
	}
	button:hover,
	input[type="submit"]:hover,
	.lol-button:hover,
	#content .lol-button:hover,
	#content .btn2,
	#content .btn3:hover,
	#content .entry-content .more-link:hover,
	#content .portfolio-tabs li a:hover,
	#content .portfolio-tabs li.active a,
	#content .faqs-tabs li a:hover,
	#content .faqs-tabs li.active a {
		background-color: <?php echo get_option('lol_second_btn_color');?>;
	}
	#content .page-row .lol-button:hover {
		color: #fff;
	}
	#content .newsletter-block .mc_form .btn-newsletter-wrap .btn-newsletter input[type="submit"] {
		background-color: <?php echo get_option('lol_third_ac_color');?>;
	}
	#content .newsletter-block .mc_form .btn-newsletter-wrap .btn-newsletter input[type="submit"]:hover {
		background-color: <?php echo get_option('lol_first_ac_color');?>;
	}

	/* bg branding */

	#branding {
		background-color: <?php echo get_option('lol_header_bg_color');?>;
	}
	.sf-menu li.current_page_item > a,
	.sf-menu li.current_page_parent > a,
	.sf-menu li.current-menu-parent > a,
	.sf-menu li.current-menu-ancestor > a,
	.sf-menu li.sfHover > a,
	.sf-menu a:hover,
	.sf-menu .sub-menu li.current_page_item > a:hover,
	.sf-menu .sub-menu li.current_page_parent > a:hover {
		color: <?php echo get_option('lol_header_bg_color');?>;
	}
	.sf-menu .megamenu_wrap > ul > li,
	.sf-menu .megamenu_wrap > ul > li > a {
		color: <?php echo get_option('lol_header_bg_color');?>!important;
	}
	.sf-menu .megamenu_wrap > ul > li > span,
	.sf-menu .megamenu_wrap > ul > li > a {
		border-bottom: 3px solid <?php echo get_option('lol_header_bg_color');?>;
	}

	/* primary font - normal weight */

	body,
	#page-title-wrap .page-title h1,
	#comments .pingback a,
	.sf-menu ul a {
		font-weight: <?php echo get_option('lol_ff_normal');?>;
	}

	/* primary font - light weight */

	#content .lol-item-heading-parallax p,
	#content .lol-item-block-banner .block-banner-content,
	#content .lol-item-block-banner-alt .block-banner-content,
	#content .full-portfolio-wrap .portfolio-item .portfolio-title div,
	#content .lol-item-member .meta-member p,
	#content #countdown .count .count-label,
	#content .lol-item-testimonial-full blockquote,
	#content .lol-item-call-to-action h3 {
		font-weight: <?php echo get_option('lol_ff_light');?>;
	}

	/* primary font - semibold weight */

	#content .about-author .bio-title span,
	#content .lol-item-mini-service-column .more,
	#content .lol-item-blog-list .entry-meta .entry-date,
	#content .lol-item-member .meta-member .member-name span,
	#content .job-list .meta-job-location,
	#sidebar .lol-love-wrap,
	#sidebar .widget_rss li .rss-date,
	#sidebar .lol_widget_twitter .timestamp,
	#sidebar .lol-posts-widget .entry-meta .entry-date,
	#sidebar .widget_recent_entries .post-date,
	#sidebar .lol-jobs-widget .entry-job span,
	#footer .lol-love-wrap,
	#footer .widget_rss li .rss-date,
	#footer .lol_widget_twitter .timestamp,
	#footer .lol-posts-widget .entry-meta .entry-date,
	#footer .widget_recent_entries .post-date,
	#footer .lol-jobs-widget .entry-job span,
	#content .price-item .price-name,
	#content .price-item .price-plan {
		font-weight: <?php echo get_option('lol_ff_semibold');?>;
	}

	/* primary font - bold weight */

	select,
	button,
	input[type="submit"],
	.lol-button,
	#content .lol-button,
	#content .btn1,
	#content .btn2,
	#content .btn3,
	#content .light-btn,
	#top-header,
	.mobile-select,
	#content .entry-header .post-meta,
	#content .footer-meta .meta-tags-wrap,
	#content .entry-content .more-link,
	#content .pagelink,
	#content .pagelink a,
	#content blockquote cite,
	#comments .commentlist .comment-meta,
	#comments .commentlist .comment-meta a,
	#comments .nocomments,
	#comments .nopassword,
	#comments .comment-logged-in,
	#comments .cancel-comment-reply,
	#comments .pingback,
	#comments #comment-nav,
	#comments #comment-nav a,
	#respond .comment-must-logged,
	#content .lol-item-block-banner.light .lol-button-block,
	#content .lol-item-block-banner.dark .lol-button-block,
	#content .lol-item-blog-list .entry-meta .entry-categories,
	#content .lol-item-portfolio-list .entry-meta .entry-categories,
	#content .progress-circle,
	#content .newsletter-block .mc_form .btn-newsletter-wrap .btn-newsletter input[type="submit"],
	#content .lol-item-info .vcard,
	#content .lol-item-call-to-action.light .lol-button-block,
	#content .lol-item-call-to-action.dark .lol-button-block,
	#content .progress-number p,
	#content .portfolio-filter .filter-description,
	#content .portfolio-item .portfolio-meta .project-categories,
	.single-lolfmk-portfolio #content .projects-navigation-wrap .projects-navigation,
	#content .pagination a,
	#content .pagination .current,
	#sidebar .widget_rss li cite,
	#sidebar .widget_tag_cloud a,
	#sidebar .lol-posts-widget .entry-meta .entry-categories,
	#sidebar .lol-projects-widget .entry-meta .entry-categories,
	#sidebar .info_widget .vcard,
	#footer .widget_rss li cite,
	#footer .widget_tag_cloud a,
	#footer.dark .widget_tag_cloud a,
	#footer .lol-posts-widget .entry-meta .entry-categories,
	#footer .lol-projects-widget .entry-meta .entry-categories,
	#footer .info_widget .vcard,
	#content .price-item .price-btn .lol-button,
	.single-attachment #content #image-navigation a,
	#content .portfolio-tabs li a,
	#content .faqs-tabs li a,
	#footer-bottom .footer-bottom-copy {
		font-weight: <?php echo get_option('lol_ff_bold');?>;
	}

	/* secondary font - normal weight */

	#content .entry-header h1,
	#content .divider h2,
	#content .divider h3,
	.divider h2,
	.divider h3,
	.widget-header h2,
	.widget-header h3,
	#content h1,
	#content h2,
	#content h3,
	#content h4,
	#content h5,
	#content h6,
	#content .lol-item-heading h2,
	#content .lol-item-heading-small h2,
	#content .lol-item-heading-parallax h2,
	#content .progress-circle .chart span,
	#content #countdown h3,
	#footer .widget .widget-header h2,
	#footer .widget .widget-header h3,
	#footer.dark .widget-header h2,
	#footer.dark .widget-header h3,
	#content .lol-skill-name {
		font-weight: <?php echo get_option('lol_sf_normal');?>;
	}

	/* secondary font - bold weight */

	#nav-menu,
	.sf-menu .megamenu_wrap > ul > li,
	.sf-menu .megamenu_wrap > ul > li > a {
		font-weight: <?php echo get_option('lol_sf_bold');?>;
	}

	/* primary font family */

	body,
	#content .full-portfolio-wrap .portfolio-item .portfolio-title div,
	#content .lol-item-call-to-action h3,
	.sf-menu ul a {
		font-family: <?php echo get_option('lol_primary_font');?>;
	}

	/* secondary font family */

	#site-title,
	#nav-menu,
	#content .entry-header h1,
	#content .divider h2,
	#content .divider h3,
	.divider h2,
	.divider h3,
	.widget-header h2,
	.widget-header h3,
	#content h1,
	#content h2,
	#content h3,
	#content h4,
	#content h5,
	#content h6,
	#content table th,
	#content .lol-item-heading h2,
	#content .lol-item-heading-small h2,
	#content .lol-item-heading-wide h2,
	#content .lol-item-heading-parallax h2,
	#content .post-item .post-meta h3,
	#content .lol-item-blog-list .entry-meta .entry-title a,
	#content .full-portfolio-wrap .portfolio-item .portfolio-title,
	#content .lol-item-portfolio-list .entry-meta .entry-title a,
	#content .lol-item-member .meta-member .member-name h3,
	#content .progress-circle .chart span,
	#content #countdown h3,
	#content #countdown .count .count-value,
	#content #countdown #count-end,
	#content .lol-toggle .lol-toggle-header,
	#content .lol-faq-wrap .lol-faq-header,
	#content .lol-faq-topic-title,
	#content .newsletter-block .newsletter-title h3,
	#content .job-list h4,
	#content .lol-item-text-banner-wrap .lol-item-text-banner h3,
	#content .progress-number .timer,
	#content .progress-number .nojs-timer,
	#content .portfolio-item .portfolio-meta h3,
	#sidebar .lol-posts-widget .entry-meta .entry-title a,
	#sidebar .lol-projects-widget .entry-meta .entry-title a,
	#footer .widget .widget-header h2,
	#footer .widget .widget-header h3,
	#footer.dark .widget-header h2,
	#footer.dark .widget-header h3,
	#footer .lol-posts-widget .entry-meta .entry-title a,
	#footer .lol-projects-widget .entry-meta .entry-title a,
	#content .price-item .price-cost,
	.sf-menu .megamenu_wrap > ul > li,
	.sf-menu .megamenu_wrap > ul > li > a,
	#content .lol-skill-name {
		font-family: <?php echo get_option('lol_secondary_font');?>;
	}
	</style>
	<?php }
}