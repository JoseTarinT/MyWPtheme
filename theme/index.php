<?php get_header(); ?>

<div class="container">
    <article class="content"> <?php 
        if (have_posts()) : 
            while (have_posts()) : the_post(); ?>

            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    <div class="postedby"><?php the_time(' F jS, Y'); ?> Posted by: <?php the_author() ?></div>
                    <?php the_excerpt(); ?>
                    <div class="postmeta"><p>Posted in: <?php the_category(', ') ?></p></div>
                </div>
                <hr>
            <?php endwhile; ?>

            <div class="navigation">
                <div class="next-posts"><?php next_posts_link(); ?></div>
                <div class="prev-posts"><?php previous_posts_link(); ?></div>
            </div>

        <?php else : ?>

            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <h1>Not Found</h1>
            </div>

        <?php endif; ?>
    </article>
</div>
<?php
get_footer();
