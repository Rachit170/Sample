<?php
/**
 * Plugin Name: Forge Car Showcase
 * Plugin URI: https://forgealbania.com
 * Description: Dynamic car showcase plugin for Forge Albania
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourportfolio.com
 * License: GPL v2 or later
 * Text Domain: forge-car-showcase
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

define('FORGE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FORGE_PLUGIN_URI', plugin_dir_url(__FILE__));

/**
 * Plugin activation hook
 */
function forge_plugin_activate() {
    // Flush rewrite rules
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'forge_plugin_activate');

/**
 * Plugin deactivation hook
 */
function forge_plugin_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'forge_plugin_deactivate');

/**
 * Load plugin text domain
 */
function forge_plugin_load_textdomain() {
    load_plugin_textdomain('forge-car-showcase', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'forge_plugin_load_textdomain');

/**
 * Add admin menu
 */
function forge_plugin_admin_menu() {
    add_submenu_page(
        'edit.php?post_type=car',
        'Car Settings',
        'Settings',
        'manage_options',
        'forge-car-settings',
        'forge_car_settings_page'
    );
}
add_action('admin_menu', 'forge_plugin_admin_menu');

/**
 * Admin page callback
 */
function forge_car_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Forge Car Showcase Settings', 'forge-car-showcase'); ?></h1>
        <form action="options.php" method="post">
            <?php settings_fields('forge_car_settings'); ?>
            <?php do_settings_sections('forge_car_settings'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Register settings
 */
function forge_register_settings() {
    register_setting('forge_car_settings', 'forge_cars_per_page');
    register_setting('forge_car_settings', 'forge_company_phone');
    register_setting('forge_car_settings', 'forge_company_email');
    register_setting('forge_car_settings', 'forge_company_address');

    add_settings_section(
        'forge_car_main',
        'Car Settings',
        'forge_car_settings_section_callback',
        'forge_car_settings'
    );

    add_settings_field(
        'forge_cars_per_page',
        'Cars Per Page',
        'forge_cars_per_page_field_callback',
        'forge_car_settings',
        'forge_car_main'
    );

    add_settings_field(
        'forge_company_phone',
        'Company Phone',
        'forge_company_phone_field_callback',
        'forge_car_settings',
        'forge_car_main'
    );

    add_settings_field(
        'forge_company_email',
        'Company Email',
        'forge_company_email_field_callback',
        'forge_car_settings',
        'forge_car_main'
    );

    add_settings_field(
        'forge_company_address',
        'Company Address',
        'forge_company_address_field_callback',
        'forge_car_settings',
        'forge_car_main'
    );
}
add_action('admin_init', 'forge_register_settings');

function forge_car_settings_section_callback() {
    echo 'Configure your car showcase settings below.';
}

function forge_cars_per_page_field_callback() {
    $value = get_option('forge_cars_per_page', 12);
    echo '<input type="number" name="forge_cars_per_page" value="' . esc_attr($value) . '" min="1" />';
}

function forge_company_phone_field_callback() {
    $value = get_option('forge_company_phone', '');
    echo '<input type="tel" name="forge_company_phone" value="' . esc_attr($value) . '" />';
}

function forge_company_email_field_callback() {
    $value = get_option('forge_company_email', '');
    echo '<input type="email" name="forge_company_email" value="' . esc_attr($value) . '" />';
}

function forge_company_address_field_callback() {
    $value = get_option('forge_company_address', '');
    echo '<textarea name="forge_company_address">' . esc_textarea($value) . '</textarea>';
}

/**
 * Shortcode for displaying cars
 */
function forge_cars_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'category' => '',
            'count'    => 6,
        ),
        $atts
    );

    $args = array(
        'post_type'      => 'car',
        'posts_per_page' => intval($atts['count']),
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'car_category',
                'field'    => 'slug',
                'terms'    => $atts['category'],
            ),
        );
    }

    $query = new WP_Query($args);
    ob_start();
    ?>
    <div class="forge-cars-shortcode">
        <div class="car-grid">
            <?php
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $price = get_post_meta(get_the_ID(), '_car_price', true);
                    $year = get_post_meta(get_the_ID(), '_car_year', true);
                    $mileage = get_post_meta(get_the_ID(), '_car_mileage', true);
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
                                <?php if ($mileage) : ?>
                                    <span class="meta-item"><?php echo esc_html($mileage); ?> km</span>
                                <?php endif; ?>
                            </div>
                            <?php the_excerpt(); ?>
                            <?php if ($price) : ?>
                                <div class="car-price">$<?php echo number_format(floatval($price), 0); ?></div>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary">View Details</a>
                        </div>
                    </div>
                    <?php
                }
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('forge_cars', 'forge_cars_shortcode');
