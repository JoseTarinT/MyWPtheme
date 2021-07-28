<?php get_header(); ?>

    <?php 
        if (have_posts()) : 
            while (have_posts()) : the_post(); ?>

                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                <?php if (is_singular()): ?>
                    <?php include "article-header-home.php"; ?>
                    <article class="content">
                        <div class="container">
                            <?php the_content(); ?> 
                        </div>
                    </article>
                <?php endif; ?>
            </div> 

        <?php endwhile; ?>

    <?php else : ?>

    <div class="container">
        <article class="content">
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <h1>Not Found</h1>
            </div>
        </article>
    </div>

    <?php endif; ?>

<?php
get_footer();
