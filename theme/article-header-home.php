<header <?php if ( has_post_thumbnail() ) {
    $imagesrc = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
        echo "style='background-image: url($imagesrc);'";
    }
    $ctoa = get_theme_mod( 'calltoaction-content', '' ); 
    $ctoaHeader = get_theme_mod( 'calltoaction-header', '' ); 
    $ctoaButton = get_theme_mod( 'calltoaction-button-text', '' ); 
    $ctoaButtonLink = get_theme_mod( 'calltoaction-button-link', '' );
    $hasText = strlen($ctoa.$ctoaHeader.$ctoaButton) > 0;
    echo 'class="d-flex align-items-end article-head' . (has_post_thumbnail() ? " has-image" : "") . ($hasText ? " has-text" : "").'"';
    ?>><?php
    if ($hasText) :
        if (strlen($ctoa.$ctoaHeader.$ctoaButton.$ctoaButtonLink) > 0) : ?>
            <div class="container calltoaction text-light d-flex flex-column align-items-stretch">
                <div class="row">
                    <div class="ctoa-content col-md-8 text-end">
                        <h2><?php echo $ctoaHeader ?></h2>
                        <?php echo $ctoa ?>
                    </div>
                    <div class="ctoa-button col-md">
                        <a class="btn btn-primary" href="<?php echo $ctoaButtonLink ?>"><?php echo $ctoaButton ?></a>
                    </div>
                </row>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</header>