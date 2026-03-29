<?php

/**
 * Configuração Inicial do Tema
 */
if (! function_exists('veredict_setup')) :
    function veredict_setup()
    {
        add_theme_support('title-tag');
        add_theme_support('custom-logo', array(
            'height'      => 100,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true
        ));
        add_theme_support('post-thumbnails');
        register_nav_menus(array(
            'primary' => __('Menu Principal', 'veredict'),
            'footer'  => __('Menu Rodapé', 'veredict')
        ));
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    }
endif;
add_action('after_setup_theme', 'veredict_setup');


/**
 * Gerenciamento de Scripts e Estilos
 */
function veredict_scripts()
{
    wp_enqueue_style('veredict-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@300;400;700&display=swap', array(), null);
    wp_enqueue_style('veredict-grid', get_template_directory_uri() . '/assets/css/grid.css', array(), '1.0.0');
    wp_enqueue_style('veredict-utilities', get_template_directory_uri() . '/assets/css/utilities.css', array(), '1.0.0');
    wp_enqueue_style('veredict-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('veredict-header', get_template_directory_uri() . '/assets/css/header.css', array('veredict-style'), '1.0.0');
    wp_enqueue_style('veredict-footer', get_template_directory_uri() . '/assets/css/footer.css', array('veredict-style'), '1.0.0');
    wp_enqueue_style('veredict-page', get_template_directory_uri() . '/assets/css/page.css', array('veredict-style'), '1.0.0');
    wp_enqueue_style('veredict-home', get_template_directory_uri() . '/assets/css/home.css', array('veredict-style'), '1.0.0');
    wp_enqueue_style('veredict-single', get_template_directory_uri() . '/assets/css/single.css', array('veredict-style'), '1.0.0');
    wp_enqueue_script('veredict_scripts', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'veredict_scripts');


/**
 * Limpeza de Performance e Segurança
 */
function veredict_cleanup()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'veredict_cleanup');


/**
 * Registro de Configurações do Customizer
 */
function veredict_custom_register($wp_customize)
{
    // ==========================================
    // CABEÇALHO
    // ==========================================
    $wp_customize->add_panel('veredict_header_panel', array('title' => 'Configurações do Cabeçalho', 'priority' => 30));

    $wp_customize->add_section('veredict_menu_section', array('title' => 'Cores e Menu', 'panel' => 'veredict_header_panel'));

    $wp_customize->add_setting('menu_link_color', array('default' => '#b79e6f', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_color_ctrl', array('label' => 'Cor dos Links', 'section' => 'veredict_menu_section', 'settings' => 'menu_link_color')));

    $wp_customize->add_setting('menu_link_hover_color', array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_hover_ctrl', array('label' => 'Cor no Hover', 'section' => 'veredict_menu_section', 'settings' => 'menu_link_hover_color')));

    $wp_customize->add_section('veredict_header_struct_section', array('title' => 'Fundo e Bordas', 'panel' => 'veredict_header_panel'));

    $wp_customize->add_setting('header_background_color', array('default' => '#070b0e', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_ctrl', array('label' => 'Cor de Fundo', 'section' => 'veredict_header_struct_section', 'settings' => 'header_background_color')));

    $wp_customize->add_section('veredict_header_btn_section', array('title' => 'Botão de Contato', 'panel' => 'veredict_header_panel'));

    $wp_customize->add_setting('header_btn_text', array('default' => 'Fale conosco', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('header_btn_text_control', array('label' => 'Texto do Botão', 'section' => 'veredict_header_btn_section', 'settings' => 'header_btn_text'));

    $wp_customize->add_setting('header_btn_url', array('default' => '#', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('header_btn_url_control', array('label' => 'Link do Botão', 'section' => 'veredict_header_btn_section', 'settings' => 'header_btn_url'));

    // ==========================================
    // RODAPÉ
    // ==========================================
    $wp_customize->add_panel('veredict_footer_panel', array('title' => 'Configurações do Rodapé', 'priority' => 40));

    $wp_customize->add_section('veredict_footer_content_section', array('title' => 'Conteúdo e Branding', 'panel' => 'veredict_footer_panel'));

    $wp_customize->add_setting('footer_description', array('default' => 'Excelência jurídica com foco em resultados estratégicos.', 'sanitize_callback' => 'sanitize_textarea_field'));
    $wp_customize->add_control('footer_description_ctrl', array('label' => 'Descrição abaixo da Logo', 'section' => 'veredict_footer_content_section', 'settings' => 'footer_description', 'type' => 'textarea'));

    $wp_customize->add_section('veredict_footer_contact_section', array('title' => 'Informações de Contato', 'panel' => 'veredict_footer_panel'));

    $wp_customize->add_setting('footer_address', array('default' => 'Porto Alegre, RS', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('footer_address_ctrl', array('label' => 'Endereço', 'section' => 'veredict_footer_contact_section', 'settings' => 'footer_address'));

    $wp_customize->add_setting('footer_email', array('default' => 'contato@veredict.com', 'sanitize_callback' => 'sanitize_email'));
    $wp_customize->add_control('footer_email_ctrl', array('label' => 'E-mail', 'section' => 'veredict_footer_contact_section', 'settings' => 'footer_email'));

    $wp_customize->add_setting('footer_phone', array('default' => '(51) 99999-9999', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('footer_phone_ctrl', array('label' => 'Telefone', 'section' => 'veredict_footer_contact_section', 'settings' => 'footer_phone'));

    $wp_customize->add_section('veredict_footer_colors_section', array('title' => 'Cores do Rodapé', 'panel' => 'veredict_footer_panel'));

    $wp_customize->add_setting('footer_title_color', array('default' => '#b79e6f', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_title_color_ctrl', array('label' => 'Cor dos Títulos', 'section' => 'veredict_footer_colors_section', 'settings' => 'footer_title_color')));

    $wp_customize->add_setting('footer_text_color', array('default' => 'rgba(255, 255, 255, 0.6)', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_text_color_ctrl', array('label' => 'Cor do Texto', 'section' => 'veredict_footer_colors_section', 'settings' => 'footer_text_color')));

    $wp_customize->add_setting('footer_background_color', array('default' => '#0d0d0d', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bg_color_ctrl', array('label' => 'Cor de Fundo', 'section' => 'veredict_footer_colors_section', 'settings' => 'footer_background_color')));

    // ==========================================
    // PÁGINAS INTERNAS E BLOG
    // ==========================================
    $wp_customize->add_section('prestige_theme_options', array('title' => 'Configurações Páginas Internas', 'priority' => 30));

    $wp_customize->add_setting('prestige_accent_color', array('default' => '#B79E6F', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'prestige_accent_color_ctrl', array('label' => 'Cor de Destaque', 'section' => 'prestige_theme_options', 'settings' => 'prestige_accent_color')));

    $wp_customize->add_setting('prestige_badge_bg', array('default' => '#070B0E', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'prestige_badge_bg_ctrl', array('label' => 'Cor de Fundo do Badge', 'section' => 'prestige_theme_options', 'settings' => 'prestige_badge_bg')));

    $wp_customize->add_setting('internal_text_home', array('default' => 'Início', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('internal_text_home', array('label' => 'Texto "Início" (Breadcrumb)', 'section' => 'prestige_theme_options'));

    $wp_customize->add_setting('internal_text_share', array('default' => 'Compartilhar:', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('internal_text_share', array('label' => 'Texto "Compartilhar"', 'section' => 'prestige_theme_options'));

    // ==========================================
    // CONFIGURAÇÕES DO POST (SINGLE)
    // ==========================================
    $wp_customize->add_section('prestige_single_post_options', array('title' => 'Configurações do Post', 'priority' => 35));

    $wp_customize->add_setting('prestige_label_prev', array('default' => 'Anterior', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('prestige_label_prev', array('label' => 'Rótulo Post Anterior', 'section' => 'prestige_single_post_options'));

    $wp_customize->add_setting('prestige_label_next', array('default' => 'Próximo', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('prestige_label_next', array('label' => 'Rótulo Próximo Post', 'section' => 'prestige_single_post_options'));

    $wp_customize->add_setting('prestige_single_title_color', array('default' => '#1a1a1a', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'prestige_single_title_color_ctrl', array('label' => 'Cor do Título (Single)', 'section' => 'prestige_single_post_options', 'settings' => 'prestige_single_title_color')));

    $wp_customize->add_setting('prestige_single_accent_color', array('default' => '#B79E6F', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'prestige_single_accent_color_ctrl', array('label' => 'Cor de Destaque Single (Badge/Bolinha)', 'section' => 'prestige_single_post_options', 'settings' => 'prestige_single_accent_color')));

    // ==========================================
    // BLOG HOME
    // ==========================================
    $wp_customize->add_section('prestige_blog_section', array('title' => 'Configurações do Blog', 'priority' => 30));

    $wp_customize->add_setting('blog_subtitle_text', array('default' => 'Análises e perspectivas estratégicas.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('blog_subtitle_text', array('label' => 'Subtítulo do Blog', 'section' => 'prestige_blog_section'));

    $wp_customize->add_setting('prestige_title_color', array('default' => '#1a1a1a', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'prestige_title_color_ctrl', array('label' => 'Cor dos Títulos', 'section' => 'prestige_blog_section', 'settings' => 'prestige_title_color')));
}
add_action('customize_register', 'veredict_custom_register');


/**
 * Injeção de CSS Dinâmico Completo
 */
function veredict_custom_css()
{
    $btn_main   = get_theme_mod('btn_color_main', '#b79e6f');
    $menu_color = get_theme_mod('menu_link_color', '#b79e6f');
    $menu_hover = get_theme_mod('menu_link_hover_color', '#ffffff');
    $header_bg  = get_theme_mod('header_background_color', '#070b0e');
    $footer_bg  = get_theme_mod('footer_background_color', '#0d0d0d');
    $footer_title = get_theme_mod('footer_title_color', '#b79e6f');
    $footer_text  = get_theme_mod('footer_text_color', 'rgba(255, 255, 255, 0.6)');
    $accent     = get_theme_mod('prestige_accent_color', '#B79E6F');
    $badge_bg   = get_theme_mod('prestige_badge_bg', '#070B0E');
    $blog_title_color = get_theme_mod('prestige_title_color', '#1a1a1a');
    $single_title_color = get_theme_mod('prestige_single_title_color', '#1a1a1a');
    $single_accent = get_theme_mod('prestige_single_accent_color', '#B79E6F');
?>
    <style type="text/css">
        #masthead {
            background-color: <?php echo $header_bg; ?> !important;
        }

        #nav-menu ul li a {
            color: <?php echo $menu_color; ?> !important;
        }

        #nav-menu ul li a:hover {
            color: <?php echo $menu_hover; ?> !important;
        }

        .btn-veredict {
            border-color: <?php echo $btn_main; ?> !important;
            color: <?php echo $btn_main; ?> !important;
        }

        footer {
            background-color: <?php echo $footer_bg; ?> !important;
        }

        #mastfooter .footer-title {
            color: <?php echo $footer_title; ?> !important;
        }

        #mastfooter .footer-description,
        #mastfooter .contact-info li,
        #mastfooter .footer-navigation ul li a {
            color: <?php echo $footer_text; ?> !important;
        }

        .post-main-title {
            color: <?php echo $single_title_color; ?> !important;
        }

        .nav-post-name,
        .prestige-page-title {
            color: <?php echo $blog_title_color; ?> !important;
        }

        .post-cat-badge,
        .nav-label,
        .prestige-breadcrumbs-alt a {
            color: <?php echo $single_accent; ?> !important;
        }

        .gold-dot {
            background-color: <?php echo $single_accent; ?> !important;
        }

        .card-cat,
        .card-btn {
            color: <?php echo $accent; ?> !important;
        }

        .gold-line {
            background-color: <?php echo $accent; ?> !important;
        }

        .badge-status-new {
            background: <?php echo $badge_bg; ?> !important;
            color: <?php echo $accent; ?> !important;
        }

        .nav-item:hover .nav-post-name {
            color: <?php echo $single_accent; ?> !important;
        }

        .prestige-link-gold {
            color: <?php echo $accent; ?>;
            border-color: <?php echo $accent; ?>;
        }

        .prestige-link-gold:hover {
            color: <?php echo $blog_title_color; ?>;
            border-color: <?php echo $blog_title_color; ?>;
        }
    </style>
<?php
}
add_action('wp_head', 'veredict_custom_css');