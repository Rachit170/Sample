<?php
/**
 * Single Car Template
 */

$price = get_post_meta(get_the_ID(), '_car_price', true);
$year = get_post_meta(get_the_ID(), '_car_year', true);
$mileage = get_post_meta(get_the_ID(), '_car_mileage', true);
$transmission = get_post_meta(get_the_ID(), '_car_transmission', true);
$fuel_type = get_post_meta(get_the_ID(), '_car_fuel_type', true);
?>

<div style="padding: 2rem 0; background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%); color: white;">
    <div class="container">
        <h1><?php the_title(); ?></h1>
    </div>
</div>

<section style="padding: 4rem 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            <div>
                <?php if (has_post_thumbnail()) : ?>
                    <div style="background: #f0f0f0; border-radius: 10px; overflow: hidden;">
                        <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto;')); ?>
                    </div>
                <?php else : ?>
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 400px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 5rem;">
                        🚗
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <div style="background: var(--light-bg); padding: 2rem; border-radius: 10px; margin-bottom: 2rem;">
                    <?php if ($price) : ?>
                        <div style="font-size: 2.5rem; color: var(--primary-color); font-weight: 700; margin-bottom: 1rem;">
                            $<?php echo number_format(floatval($price), 0); ?>
                        </div>
                    <?php endif; ?>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
                        <?php if ($year) : ?>
                            <div>
                                <strong><?php _e('Year:', 'forge-albania'); ?></strong>
                                <p><?php echo esc_html($year); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($mileage) : ?>
                            <div>
                                <strong><?php _e('Mileage:', 'forge-albania'); ?></strong>
                                <p><?php echo esc_html($mileage); ?> km</p>
                            </div>
                        <?php endif; ?>

                        <?php if ($transmission) : ?>
                            <div>
                                <strong><?php _e('Transmission:', 'forge-albania'); ?></strong>
                                <p><?php echo esc_html(ucfirst($transmission)); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($fuel_type) : ?>
                            <div>
                                <strong><?php _e('Fuel Type:', 'forge-albania'); ?></strong>
                                <p><?php echo esc_html(ucfirst($fuel_type)); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-secondary" style="width: 100%; text-align: center;">
                        <?php _e('Inquire About This Vehicle', 'forge-albania'); ?>
                    </a>
                </div>

                <?php
                $categories = get_the_terms(get_the_ID(), 'car_category');
                if ($categories && !is_wp_error($categories)) :
                    ?>
                    <div>
                        <strong><?php _e('Category:', 'forge-albania'); ?></strong>
                        <p>
                            <?php
                            foreach ($categories as $category) {
                                echo '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                            }
                            ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div style="background: var(--light-bg); padding: 2rem; border-radius: 10px;">
            <h2><?php _e('Description', 'forge-albania'); ?></h2>
            <?php the_content(); ?>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="<?php echo esc_url(home_url('/cars')); ?>" class="btn"><?php _e('Back to Fleet', 'forge-albania'); ?></a>
        </div>
    </div>
</section>
