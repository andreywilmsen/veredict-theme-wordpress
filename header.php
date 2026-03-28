<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('UTF-8'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header id="masthead" class="container-fluid">
        <div class="container-header d-flex justify-content-between align-items-center">
            <div class="col-2 logotipo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h1><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></h1>';
                }
                ?>
            </div>
            <button class="mobile-menu-toggle" aria-label="Abrir Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav id="nav-menu" class="col-7 main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => false
                ));
                ?>
            </nav>
            <div class="contact-us col-3 d-flex justify-content-end">
                <?php
                $btn_text = get_theme_mod('header_btn_text', 'Fale conosco');
                $btn_url  = get_theme_mod('header_btn_url', '#');

                if (! empty($btn_text)) : ?>
                    <a href="<?php echo esc_url($btn_url); ?>" class="btn-veredict">
                        <?php echo esc_html($btn_text); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>