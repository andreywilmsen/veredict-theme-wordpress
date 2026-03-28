<footer id="mastfooter" class="website-footer">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos os direitos reservados.</p>
        <nav class="footer-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'container' => false,
                'depth' => 1
            ));
            ?>
        </nav>
    </div>

</footer>
<?php wp_footer(); ?>
</body>

</html>