<?php get_header(); ?>
<header <?php if ( has_post_thumbnail() ) {
    $imagesrc = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
    echo "style='background-image: url($imagesrc);'";
}?> class="d-flex align-items-end article-head<?php echo has_post_thumbnail() ? " has-image" : ""?>">
</header>
<div class="container">
    <article class="content">
            <?php the_post(); ?>

            <h2><?php the_title(); ?></h2>

            <?php the_content(); ?>   
    </article>
</div>
<?php
get_footer();
