<?php /* Template Name: content-with-sidebar */
get_header(); ?>
<div class="container-fluid">
    <div class="row justify-content-center no-gutters">
        <div class="col-12 wrapper">
            <div class="row justify-content-center">
                <div class='col-11 col-md-7'>
                    <div class="content">
                        <?php the_post(); ?>
                        <h2><?php the_title(); ?></h2>
                        <?php the_content(); ?>   
                    </div>
                </div>
                <div class="smallspacer col-12 d-md-none d-lg-none d-xl-none"></div>

                <?php get_template_part('template-parts/sidebar'); ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
