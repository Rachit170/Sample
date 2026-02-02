<?php
/**
 * Default Content Template
 */
?>

<div style="padding: 2rem 0; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%); color: white;">
    <div class="container">
        <?php the_title('<h1>', '</h1>'); ?>
    </div>
</div>

<section style="padding: 4rem 0;">
    <div class="container">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content();
            }
        }
        ?>
    </div>
</section>
