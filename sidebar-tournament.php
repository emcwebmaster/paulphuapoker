<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paulphuapoker
 */

if ( ! is_active_sidebar( 'sidebar-tournament' ) ) {
	return;
}
?>

<aside id="sidebar-tournament" class="container">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-tournament') ) ?>
</aside><!-- #sidebar-tournament -->








