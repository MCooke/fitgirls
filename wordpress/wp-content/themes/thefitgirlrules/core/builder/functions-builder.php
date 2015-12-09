<?php
/**
 * Lollum
 * 
 * Core functions and definitions
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

/******************************
* calculate size items and 
* pass some stuff
******************************/

if (!function_exists('lolfmk_size_items')) {
	function lolfmk_size_items($item_args) {
		global $lolfmk_full_size;
		$lolfmk_full_size = (empty($lolfmk_full_size)) ? 0 : $lolfmk_full_size;

		$id = ($item_args['id'] != '') ? 'id="'.$item_args['id'].'"' : '';
		$class = (isset($item_args['class']) && $item_args['class'] != '') ? $item_args['class'] : '';
		$image = (isset($item_args['image']) && $item_args['image'] != '') ? 'background-image:url('.$item_args['image'].');' : '';
		$color = (isset($item_args['color']) && $item_args['color'] != '') ? 'background-color:'.$item_args['color'].';' : '';
		$is_full = (isset($item_args['full']) && $item_args['full'] != '') ? true : false;

		$style = ($image == '' && $color == '') ? '' : 'style="'.$image.$color.'"';

		if ($lolfmk_full_size >= 1 || ($lolfmk_full_size + .24) >= 1) {
			echo '</div>' . "\n";
			echo '</div>' . "\n";
			echo '</div>' . "\n";
			echo '<!-- END page-row -->' . "\n" . "\n";
			$lolfmk_full_size = 0;
		}
		if ($lolfmk_full_size == 0) {
			if ($is_full) { 
				echo '<!-- BEGIN page-row -->' . "\n";
				echo '<div class="page-row '.$class.'" '.$style.'>' . "\n";
				echo '<div>' . "\n";
				echo '<div>' . "\n";
			} else {
				echo '<!-- BEGIN page-row -->' . "\n";
				echo '<div class="page-row '.$class.'" '.$style.'>' . "\n";
				echo '<div class="container">' . "\n";
				echo '<div class="row">' . "\n";
			}
		}

		switch($item_args['size_item']) {
			case '1-4':
				echo '<div class="col-3 lol-page-item" '.$id.'>';
				$lolfmk_full_size += 1/4;
				break;
			case '1-3':
				echo '<div class="col-4 lol-page-item " '.$id.'>';
				$lolfmk_full_size += 1/3;
				break;
			case '1-2':
				echo '<div class="col-6 lol-page-item" '.$id.'>';
				$lolfmk_full_size += 1/2;
				break;
			case '2-3':
				echo '<div class="col-8 lol-page-item" '.$id.'>';
				$lolfmk_full_size += 2/3;
				break;
			case '3-4':
				echo '<div class="col-9 lol-page-item" '.$id.'>';
				$lolfmk_full_size += 3/4;
				break;
			case '1-1':
				if (!$is_full) { 
					echo '<div class="col-12 lol-page-item" '.$id.'>';
				}
				$lolfmk_full_size += 1;
				break;
		}
	}
}

$builder_path = 'core/builder/blocks/block';

/******************************
* column block
******************************/

get_template_part($builder_path, 'column');

/******************************
* divider block
******************************/

get_template_part($builder_path, 'divider');

/******************************
* space block
******************************/

get_template_part($builder_path, 'space');

/******************************
* line block
******************************/

get_template_part($builder_path, 'line');

/******************************
* heading block
******************************/

get_template_part($builder_path, 'heading');

/******************************
* heading small block
******************************/

get_template_part($builder_path, 'heading-small');

/******************************
* heading wide block
******************************/

get_template_part($builder_path, 'heading-wide');

/******************************
* heading parallax block
******************************/

get_template_part($builder_path, 'heading-parallax');

/******************************
* image block
******************************/

get_template_part($builder_path, 'image');

/******************************
* image parallax block
******************************/

get_template_part($builder_path, 'image-parallax');

/******************************
* image text block
******************************/

get_template_part($builder_path, 'image-text');

/******************************
* service column block
******************************/

get_template_part($builder_path, 'service-column');

/******************************
* mini-service column block
******************************/

get_template_part($builder_path, 'mini-service-column');

/******************************
* feature block
******************************/

get_template_part($builder_path, 'feature');

/******************************
* embed video block
******************************/

get_template_part($builder_path, 'embed-video');

/******************************
* banner block
******************************/

get_template_part($builder_path, 'banner');

/******************************
* banner (alt) block
******************************/

get_template_part($builder_path, 'banner-alt');

/******************************
* text banner block
******************************/

get_template_part($builder_path, 'text-banner');

/******************************
* post block
******************************/

get_template_part($builder_path, 'post');

/******************************
* blog full block
******************************/

get_template_part($builder_path, 'blog-full');

/******************************
* blog list block
******************************/

get_template_part($builder_path, 'blog-list');

/******************************
* project block
******************************/

get_template_part($builder_path, 'project');

/******************************
* portfolio full block
******************************/

get_template_part($builder_path, 'portfolio-full');

/******************************
* portfolio list block
******************************/

get_template_part($builder_path, 'portfolio-list');

/******************************
* portfolio filter
******************************/

get_template_part($builder_path, 'portfolio-filter');

/******************************
* member block
******************************/

get_template_part($builder_path, 'member');

/******************************
* testimonial full block
******************************/

get_template_part($builder_path, 'testimonial-full');

/******************************
* progress circle block
******************************/

get_template_part($builder_path, 'progress-circle');

/******************************
* progress number block
******************************/

get_template_part($builder_path, 'progress-number');

/******************************
* countdown block
******************************/

get_template_part($builder_path, 'countdown');

/******************************
* toggle block
******************************/

get_template_part($builder_path, 'toggle');

/******************************
* FAQs block
******************************/

get_template_part($builder_path, 'faqs');

/******************************
* brands parallax block
******************************/

get_template_part($builder_path, 'brands-parallax');

/******************************
* map block
******************************/

get_template_part($builder_path, 'map');

/******************************
* full map block
******************************/

get_template_part($builder_path, 'full-map');

/******************************
* call to action block
******************************/

get_template_part($builder_path, 'call-to-action');

/******************************
* info block
******************************/

get_template_part($builder_path, 'info');

/******************************
* mailchimp block
******************************/

get_template_part($builder_path, 'mailchimp');

/******************************
* job list block
******************************/

get_template_part($builder_path, 'job-list');