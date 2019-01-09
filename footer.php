<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paulphuapoker
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info container">
			<?php if ( have_rows( 'footer', 'option' ) ): ?>
				<?php while ( have_rows( 'footer', 'option' ) ) : the_row(); ?>
					<?php if ( get_row_layout() == 'footer' ) : ?>
						<div id="column-1">
							<?php if ( have_rows( 'column1' ) ): ?>
								<?php while ( have_rows( 'column1' ) ) : the_row(); ?>
									<?php if ( get_row_layout() == 'column1' ) : ?>
										<?php if ( get_sub_field( 'footer_logo' ) ) { ?>
											<img src="<?php the_sub_field( 'footer_logo' ); ?>" alt="Paul Phua Poker Logo" />
										<?php } ?>
										<p><?php the_sub_field( 'copyright' ); ?></p>
									<?php endif; ?>
								<?php endwhile; ?>
							<?php else: ?>
								<?php // no layouts found ?>
							<?php endif; ?>
						</div>
						<div id="column-2">
							<?php if ( have_rows( 'column2' ) ): ?>
								<?php while ( have_rows( 'column2' ) ) : the_row(); ?>
									<?php if ( get_row_layout() == 'column2' ) : ?>
									<h4>LINKS</h4>
										<?php wp_nav_menu( array( 
											'theme_location' => 'footer-menu'
											) ); ?>
									<?php endif; ?>
								<?php endwhile; ?>
							<?php else: ?>
								<?php // no layouts found ?>
							<?php endif; ?>
						</div>
						<div id="column-3">
							<?php the_sub_field( 'column3' ); ?>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php else: ?>
				<?php // no layouts found ?>
			<?php endif; ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
