<?php
/**
 * Footer Template
 */
?>
    <footer>
        <div class="container">
            <div class="footer-content">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'forge-albania'); ?></p>
                <ul class="footer-links">
                    <li><a href="<?php echo home_url('/'); ?>"><?php _e('Home', 'forge-albania'); ?></a></li>
                    <li><a href="<?php echo home_url('/cars'); ?>"><?php _e('Our Cars', 'forge-albania'); ?></a></li>
                    <li><a href="<?php echo home_url('/contact'); ?>"><?php _e('Contact', 'forge-albania'); ?></a></li>
                </ul>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
