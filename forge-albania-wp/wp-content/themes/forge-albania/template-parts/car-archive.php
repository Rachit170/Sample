<?php
/**
 * Car Archive Template
 */

$categories = get_terms(array(
    'taxonomy'   => 'car_category',
    'hide_empty' => true,
));

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = array(
    'post_type'      => 'car',
    'posts_per_page' => 12,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$cars = new WP_Query($args);
?>

<div style="padding: 2rem 0; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%); color: white;">
    <div class="container">
        <h1><?php _e('Our Fleet', 'forge-albania'); ?></h1>
    </div>
</div>

<section style="padding: 4rem 0;">
    <div class="container">
        <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
            <div class="filters">
                <button class="filter-btn active" data-filter="all"><?php _e('All', 'forge-albania'); ?></button>
                <?php foreach ($categories as $category) : ?>
                    <button class="filter-btn" data-filter="<?php echo esc_attr($category->slug); ?>">
                        <?php echo esc_html($category->name); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="car-grid" id="carGrid">
            <?php
            if ($cars->have_posts()) {
                while ($cars->have_posts()) {
                    $cars->the_post();
                    $price = get_post_meta(get_the_ID(), '_car_price', true);
                    $year = get_post_meta(get_the_ID(), '_car_year', true);
                    $mileage = get_post_meta(get_the_ID(), '_car_mileage', true);
                    $fuel_type = get_post_meta(get_the_ID(), '_car_fuel_type', true);
                    ?>
                    <div class="car-card">
                        <div class="car-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <span>🚗</span>
                            <?php endif; ?>
                        </div>
                        <div class="car-content">
                            <h3 class="car-title"><?php the_title(); ?></h3>
                            <div class="car-meta">
                                <?php if ($year) : ?>
                                    <span class="meta-item"><?php echo esc_html($year); ?></span>
                                <?php endif; ?>
                                <?php if ($fuel_type) : ?>
                                    <span class="meta-item"><?php echo esc_html(ucfirst($fuel_type)); ?></span>
                                <?php endif; ?>
                                <?php if ($mileage) : ?>
                                    <span class="meta-item"><?php echo esc_html($mileage); ?> km</span>
                                <?php endif; ?>
                            </div>
                            <?php the_excerpt(); ?>
                            <?php if ($price) : ?>
                                <div class="car-price">$<?php echo number_format(floatval($price), 0); ?></div>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary"><?php _e('View Details', 'forge-albania'); ?></a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>' . __('No cars found.', 'forge-albania') . '</p>';
            }
            wp_reset_postdata();
            ?>
        </div>

        <!-- Pagination -->
        <div style="text-align: center; margin-top: 3rem;">
            <?php
            echo paginate_links(array(
                'total'  => $cars->max_num_pages,
                'current' => $paged,
            ));
            ?>
        </div>
    </div>
</section>
