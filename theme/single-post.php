<?php get_header(); ?>

<div class="container">
    <article class="content"> 
        <?php the_post() ?>
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <h1><?php the_title(); ?></h1>
            <div class="postedby"><?php the_time(' F jS, Y'); ?> Posted by: <?php the_author() ?></div>
            <?php the_content(); ?>
            
            <div class="postmeta"><p>Posted in: <?php the_category(', ') ?></p></div>
        </div>
    </article>
</div>
<?php
get_footer();

