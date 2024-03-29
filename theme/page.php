<?php get_header(); ?>
<div class="container pb-5 bg-secondary">
    <header <?php if ( has_post_thumbnail() ) {
        $imagesrc = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
        echo "style='background-image: url($imagesrc);'";
    }?> class="d-flex align-items-end article-head img-thumbnail<?php echo has_post_thumbnail() ? " has-image" : ""?>">
    </header>
    <div class="container-divider-a">
                    <div class="divider-a">
                        <span class="divider-separator-a"></span>
                    </div>
                </div>
    <div class="container">
        <article class="content">
                <?php the_post(); ?>

                <h2><?php the_title(); ?></h2>

                <?php the_content(); ?>   
        </article>
    </div>
</div>
<?php get_footer();
