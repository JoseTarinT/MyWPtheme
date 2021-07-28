<header <?php if ( has_post_thumbnail() ) {
    $imagesrc = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
        echo "style='background-image: url($imagesrc);'";
    }
    echo 'class="d-flex align-items-end article-head' . (has_post_thumbnail() ? " has-image" : "").'"'; ?>
>
</header>