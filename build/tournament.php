<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( get_field( 'tournament_image' ) ) { ?>
	<a href="<?php the_permalink(); ?>"><img src="<?php the_field( 'tournament_image' ); ?>" alt="<?php the_title(); ?>" /></a>
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<?php } ?>
</article>