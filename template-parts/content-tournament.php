<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( get_field( 'tournament_image' ) ) { ?>
	<div class="tournament-thumbnail hvr-bubble-float-bottom">
        <a href="<?php the_permalink(); ?>"><img src="<?php the_field( 'tournament_image' ); ?>" alt="<?php the_title(); ?>" /></a>
    </div>
    <div class="tournament-details">
        <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
        <p><?php the_field( 'tournament_info' ); ?></p>
        <a href="<?php the_permalink(); ?>" class="hvr-float-shadow">Read More</a>
    </div>
<?php } ?>
</article>