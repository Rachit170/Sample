<?php
/**
 * Main Template File
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    if (is_front_page()) {
        get_template_part('template-parts/hero');
        get_template_part('template-parts/car-showcase');
        get_template_part('template-parts/features');
        get_template_part('template-parts/contact');
    } elseif (is_archive() && get_post_type() === 'car') {
        get_template_part('template-parts/car-archive');
    } elseif (is_singular('car')) {
        get_template_part('template-parts/car-single');
    } else {
        get_template_part('template-parts/content');
    }
    ?>
</main>

<?php get_footer();
