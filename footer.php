<footer id="mastfooter" class="website-footer" role="contentinfo">
    <div class="container-footer">
        <div class="footer-grid">

            <div class="footer-column branding">
                <div class="footer-logo">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<h2 class="logotipo"><a href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a></h2>';
                    }
                    ?>
                </div>
                <p class="footer-description">
                    <?php echo esc_html(get_theme_mod('footer_description', __('Excelência jurídica com foco em resultados estratégicos.', 'veredict'))); ?>
                </p>
            </div>

            <div class="footer-column navigation">
                <h3 class="footer-title"><?php esc_html_e('Navegação', 'veredict'); ?></h3>
                <nav class="footer-navigation" aria-label="<?php esc_attr_e('Menu do Rodapé', 'veredict'); ?>">
                    <?php
                    if (has_nav_menu('footer')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'container'      => false,
                            'menu_class'     => 'footer-links',
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        ));
                    }
                    ?>
                </nav>
            </div>

            <div class="footer-column contact">
                <h3 class="footer-title"><?php esc_html_e('Contato', 'veredict'); ?></h3>
                <ul class="contact-info">
                    <li><?php echo esc_html(get_theme_mod('footer_address', 'Porto Alegre, RS')); ?></li>
                    <li><?php
                        $email = get_theme_mod('footer_email', 'contato@veredict.com');
                        echo '<a href="' . esc_url('mailto:' . $email) . '">' . esc_html(antispambot($email)) . '</a>';
                        ?></li>
                    <li><?php echo esc_html(get_theme_mod('footer_phone', '(51) 99999-9999')); ?></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>
                &copy; <?php echo date('Y'); ?> <?php echo esc_html(get_bloginfo('name')); ?>.
                <?php esc_html_e('Todos os direitos reservados.', 'veredict'); ?>
                <span class="sep"> | </span>
                <?php
                printf(
                    esc_html__('Desenvolvido por %s', 'veredict'),
                    '<a href="' . esc_url('https://salomind.com') . '" target="_blank" rel="designer">Andrey Wilmsen</a>'
                );
                ?>
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>