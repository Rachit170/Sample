<?php
/**
 * Forge Albania Theme Functions
 */

// Disable direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('FORGE_THEME_VERSION', '1.0.0');
define('FORGE_THEME_DIR', get_template_directory());
define('FORGE_THEME_URI', get_template_directory_uri());

/**
 * Setup theme
 */
function forge_albania_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'forge-albania'),
        'footer'  => __('Footer Menu', 'forge-albania'),
    ));
}
add_action('after_setup_theme', 'forge_albania_setup');

/**
 * Enqueue scripts and styles
 */
function forge_albania_scripts() {
    // Styles
    wp_enqueue_style('forge-albania-style', get_stylesheet_uri(), array(), FORGE_THEME_VERSION);

    // Scripts
    wp_enqueue_script('forge-albania-script', FORGE_THEME_URI . '/assets/js/main.js', array('jquery'), FORGE_THEME_VERSION, true);

    // Localize script for AJAX
    wp_localize_script('forge-albania-script', 'forgeAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('forge_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'forge_albania_scripts');

/**
 * Register sidebar
 */
function forge_albania_widgets_init() {
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'forge-albania'),
        'id'            => 'primary-sidebar',
        'description'   => __('Main sidebar', 'forge-albania'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'forge_albania_widgets_init');

/**
 * Custom post type for Cars
 */
function forge_register_car_post_type() {
    $args = array(
        'labels'             => array(
            'name'               => _x('Cars', 'Post Type General Name', 'forge-albania'),
            'singular_name'      => _x('Car', 'Post Type Singular Name', 'forge-albania'),
            'menu_name'          => __('Cars', 'forge-albania'),
            'add_new_item'       => __('Add New Car', 'forge-albania'),
            'edit_item'          => __('Edit Car', 'forge-albania'),
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'cars'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-car',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('car', $args);
}
add_action('init', 'forge_register_car_post_type');

/**
 * Register taxonomy for car categories
 */
function forge_register_car_taxonomy() {
    $args = array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'          => _x('Car Categories', 'taxonomy general name', 'forge-albania'),
            'singular_name' => _x('Car Category', 'taxonomy singular name', 'forge-albania'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'car-category'),
    );

    register_taxonomy('car_category', array('car'), $args);
}
add_action('init', 'forge_register_car_taxonomy');

/**
 * Add custom meta boxes for car details
 */
function forge_add_car_meta_boxes() {
    add_meta_box(
        'car_details',
        __('Car Details', 'forge-albania'),
        'forge_car_details_callback',
        'car',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'forge_add_car_meta_boxes');

/**
 * Meta box callback
 */
function forge_car_details_callback($post) {
    wp_nonce_field('forge_car_details_nonce', 'forge_car_details_nonce');

    $price = get_post_meta($post->ID, '_car_price', true);
    $year = get_post_meta($post->ID, '_car_year', true);
    $mileage = get_post_meta($post->ID, '_car_mileage', true);
    $transmission = get_post_meta($post->ID, '_car_transmission', true);
    $fuel_type = get_post_meta($post->ID, '_car_fuel_type', true);

    ?>
    <div class="car-meta-fields">
        <p>
            <label for="car_price"><?php _e('Price:', 'forge-albania'); ?></label>
            <input type="number" id="car_price" name="car_price" value="<?php echo esc_attr($price); ?>" step="0.01" />
        </p>
        <p>
            <label for="car_year"><?php _e('Year:', 'forge-albania'); ?></label>
            <input type="number" id="car_year" name="car_year" value="<?php echo esc_attr($year); ?>" />
        </p>
        <p>
            <label for="car_mileage"><?php _e('Mileage (km):', 'forge-albania'); ?></label>
            <input type="number" id="car_mileage" name="car_mileage" value="<?php echo esc_attr($mileage); ?>" />
        </p>
        <p>
            <label for="car_transmission"><?php _e('Transmission:', 'forge-albania'); ?></label>
            <select id="car_transmission" name="car_transmission">
                <option value="">Select Transmission</option>
                <option value="manual" <?php selected($transmission, 'manual'); ?>>Manual</option>
                <option value="automatic" <?php selected($transmission, 'automatic'); ?>>Automatic</option>
            </select>
        </p>
        <p>
            <label for="car_fuel_type"><?php _e('Fuel Type:', 'forge-albania'); ?></label>
            <select id="car_fuel_type" name="car_fuel_type">
                <option value="">Select Fuel Type</option>
                <option value="petrol" <?php selected($fuel_type, 'petrol'); ?>>Petrol</option>
                <option value="diesel" <?php selected($fuel_type, 'diesel'); ?>>Diesel</option>
                <option value="hybrid" <?php selected($fuel_type, 'hybrid'); ?>>Hybrid</option>
                <option value="electric" <?php selected($fuel_type, 'electric'); ?>>Electric</option>
            </select>
        </p>
    </div>
    <?php
}

/**
 * Save car meta data
 */
function forge_save_car_meta($post_id) {
    if (!isset($_POST['forge_car_details_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['forge_car_details_nonce'], 'forge_car_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    $fields = array('car_price', 'car_year', 'car_mileage', 'car_transmission', 'car_fuel_type');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_car', 'forge_save_car_meta');

/**
 * AJAX handler for car filtering
 */
function forge_filter_cars() {
    check_ajax_referer('forge_nonce', 'nonce');

    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    $args = array(
        'post_type'      => 'car',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'car_category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    $query = new WP_Query($args);
    $response = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $response[] = array(
                'id'       => get_the_ID(),
                'title'    => get_the_title(),
                'excerpt'  => get_the_excerpt(),
                'image'    => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                'price'    => get_post_meta(get_the_ID(), '_car_price', true),
                'year'     => get_post_meta(get_the_ID(), '_car_year', true),
                'mileage'  => get_post_meta(get_the_ID(), '_car_mileage', true),
                'link'     => get_permalink(),
            );
        }
    }

    wp_reset_postdata();

    wp_send_json_success($response);
    wp_die();
}
add_action('wp_ajax_forge_filter_cars', 'forge_filter_cars');
add_action('wp_ajax_nopriv_forge_filter_cars', 'forge_filter_cars');

/**
 * Custom excerpt length
 */
function forge_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'forge_custom_excerpt_length');
