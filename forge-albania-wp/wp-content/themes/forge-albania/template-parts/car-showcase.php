<?php
/**
 * Car Showcase Section Template
 */

$categories = get_terms(array(
    'taxonomy'   => 'car_category',
    'hide_empty' => true,
));

$args = array(
    'post_type'      => 'car',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$cars = new WP_Query($args);
?>

<section class="car-showcase">
    <div class="container">
        <h2 class="section-title"><?php _e('Our Featured Fleet', 'forge-albania'); ?></h2>

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
                wp_reset_postdata();
            }
            ?>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="<?php echo esc_url(home_url('/cars')); ?>" class="btn"><?php _e('View All Vehicles', 'forge-albania'); ?></a>
        </div>
    </div>
</section>
