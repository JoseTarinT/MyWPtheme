<?php get_header(); ?>

    <main id="primary" class="site-main">

        <section class="container pb-5 pt-5 bg-secondary">

            <?php if(has_post_thumbnail()):?>

                <img src="<?php the_post_thumbnail_url();?>" alt="" class="img-fluid">

            <?php endif;?>

            <div class="container-divider-a">
                <div class="divider-a">
                    <span class="divider-separator-a"></span>
                </div>
            </div>
            <!--<div class="line">
                <span class="divider"></span>
            </div>-->
            
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

            <div class="container-divider-b">
                <div class="divider-b">
                    <span class="divider-separator-b"></span>
                </div>
            </div>
        </section>

<?php
get_footer();
