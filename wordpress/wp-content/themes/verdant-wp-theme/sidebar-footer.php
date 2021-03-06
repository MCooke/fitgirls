<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Verdant
 */

if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) ) {
	return;
}

$activeSidebars = 0;
$activeSidebars += is_active_sidebar( 'footer-1' ) ? 1 : 0;
$activeSidebars += is_active_sidebar( 'footer-2' ) ? 1 : 0;
$activeSidebars += is_active_sidebar( 'footer-3' ) ? 1 : 0;
?>

<div class="footer-widgets active-footers-<?php echo esc_attr( $activeSidebars ) ?>">

<?php
if ( is_active_sidebar( 'footer-1' ) ) {
	?>
	<div id="footer-left" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div><!-- #footer-left -->
	<?php
}

if ( is_active_sidebar( 'footer-2' ) ) {
	?>
	<div id="footer-middle" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-2' ); ?>
	</div><!-- #footer-middle -->
	<?php
}

if ( is_active_sidebar( 'footer-3' ) ) {
	?>
	<div id="footer-right" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-3' ); ?>
	</div><!-- #footer-right -->
	<?php
}
?>

</div>