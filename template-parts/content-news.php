<div id="news-archive-item" class="hvr-bubble-float-bottom">
<?php $thumb_url = get_the_post_thumbnail_url($post->ID); ?>
    <a href="<?php the_permalink(); ?>"><img src="<?= $thumb_url ?>" alt="<?php the_title(); ?>"/></a>
    <a href="<?php the_permalink(); ?>">
        <p>
            <?php
            $thetitle = $post->post_title; /* or you can use get_the_title() */
            $getlength = strlen($thetitle);
            $thelength = 60;
            echo substr($thetitle, 0, $thelength);
            if ($getlength > $thelength) echo "...";
            ?>
        </p>
    </a>
</div>