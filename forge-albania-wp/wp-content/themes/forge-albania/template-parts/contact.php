<?php
/**
 * Contact Section Template
 */
?>

<section class="contact-section">
    <div class="container">
        <div class="contact-wrapper">
            <h2><?php _e('Get in Touch', 'forge-albania'); ?></h2>

            <?php
            // Display Contact Form 7 shortcode if plugin is active
            if (function_exists('wpcf7_enqueue_scripts')) {
                echo do_shortcode('[contact-form-7 id="contact-form" title="Contact Form"]');
            } else {
                // Fallback simple form
                ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name"><?php _e('Name', 'forge-albania'); ?></label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email"><?php _e('Email', 'forge-albania'); ?></label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone"><?php _e('Phone', 'forge-albania'); ?></label>
                        <input type="tel" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="message"><?php _e('Message', 'forge-albania'); ?></label>
                        <textarea id="message" name="message" required></textarea>
                    </div>

                    <button type="submit" class="btn"><?php _e('Send Message', 'forge-albania'); ?></button>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
</section>
