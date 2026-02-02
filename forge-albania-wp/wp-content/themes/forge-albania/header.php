<?php
/**
 * Header Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo esc_html(bloginfo('name'));
                    }
                    ?>
                </div>
                <nav class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'fallback_cb'    => 'wp_page_menu',
                        'depth'          => 2,
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </header>
