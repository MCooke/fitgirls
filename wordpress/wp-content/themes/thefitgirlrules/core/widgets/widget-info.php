<?php
/**
 * Lollum
 * 
 * Custom Info Widget
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

class Lollum_Widget_Info extends WP_Widget {

	function Lollum_Widget_Info() {

		$widget_ops = array(
			'classname' => 'lol_widget_info', 
			'description' => __('Use this widget to display your company information.', 'lollum') 
		);
		$control_ops = array('id_base' => 'lol_widget_info');
		$this->WP_Widget('lol_widget_info', __('Custom Info Widget', 'lollum'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {

		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if ($title) { 
			echo $before_title . $title . $after_title; 
		}

		$text = $instance['text'];
		$address = $instance['address'];
		$tel = $instance['tel'];
		$fax = $instance['fax'];
		$email = $instance['email'];
		$web = $instance['web'];
		?>
			
		<div class="info_widget">
			<?php if ($text) { ?>
				<p class="contact-information"><?php echo $text; ?></p>
			<?php } ?>

			<div class="vcard">
			<?php if ($address != '') { ?>
				<div class="adr"><i class="icon fa fa-home"></i><?php echo $address; ?></div>
			<?php } ?>
			<?php if ($tel != '') { ?>
				<div class="tel"><i class="icon fa fa-phone"></i><?php echo $tel; ?></div>
			<?php } ?>
			<?php if ($fax != '') { ?>
				<div class="fax"><i class="icon fa fa-print"></i><?php echo $fax; ?></div>
			<?php } ?>
			<?php if ($email != '') { ?>
				<div class="email"><i class="icon fa fa-envelope"></i><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
			<?php } ?>
			<?php if ($web != '') { ?>
				<div class="website"><i class="icon fa fa-globe"></i><a href="http://<?php echo $web; ?>"><?php echo $web; ?></a></div>
			<?php } ?>
			</div>
		</div>
	
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['tel'] = strip_tags($new_instance['tel']);
		$instance['fax'] = strip_tags($new_instance['fax']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['web'] = strip_tags($new_instance['web']);

		return $instance;
	}

	function form($instance) {

		$defaults = array(
			'title' => 'Contact Info'
		);

		$instance = wp_parse_args((array) $instance, $defaults); 

		$text = (isset($instance['text']) ? $instance['text'] : '');
		$address = (isset($instance['address']) ? $instance['address'] : '');
		$tel = (isset($instance['tel']) ? $instance['tel'] : '');
		$fax = (isset($instance['fax']) ? $instance['fax'] : '');
		$email = (isset($instance['email']) ? $instance['email'] : '');
		$web = (isset($instance['web']) ? $instance['web'] : '');

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text info:', 'lollum') ?></label>
			<textarea style="height: 150px;" class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo stripslashes(htmlspecialchars($text, ENT_QUOTES)); ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $address; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('tel'); ?>"><?php _e('Tel:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('tel'); ?>" name="<?php echo $this->get_field_name('tel'); ?>" value="<?php echo $tel; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo $fax; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('E-mail:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $email; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('web'); ?>"><?php _e('Web:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('web'); ?>" name="<?php echo $this->get_field_name('web'); ?>" value="<?php echo $web; ?>">
		</p>

	<?php
	}

}

add_action('widgets_init', 'lol_info_widget');

function lol_info_widget() {
	register_widget('Lollum_Widget_Info');
}