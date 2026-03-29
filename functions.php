<?php

/**
 * Configuração Inicial do Tema
 * Este bloco habilita recursos essenciais do WordPress como o título dinâmico,
 * suporte a logotipos personalizados, imagens destacadas e menus de navegação.
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
 * Carrega o arquivo style.css principal de forma otimizada para o navegador.
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
    wp_enqueue_script('veredict_scripts', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'veredict_scripts');


/**
 * Limpeza de Performance e Segurança
 * Remove códigos inúteis injetados pelo WordPress no cabeçalho (wp_head)
 * para acelerar o carregamento e proteger a versão do sistema.
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
 * Registro de Configurações do Customizer (Painel de Personalização)
 * Permite ao usuário alterar cores de links, botões, fundo e bordas do cabeçalho
 * diretamente pela interface administrativa do WordPress em tempo real.
 */
function veredict_custom_register($wp_customize)
{

    // ==========================================
    // PAINEL: CABEÇALHO (Agrupando tudo)
    // ==========================================
    $wp_customize->add_panel('veredict_header_panel', array(
        'title'       => 'Configurações do Cabeçalho',
        'priority'    => 30,
    ));

    // Seção: Cores e Estilo do Menu
    $wp_customize->add_section('veredict_menu_section', array(
        'title'    => 'Cores e Menu',
        'panel'    => 'veredict_header_panel',
    ));

    // Links e Hovers
    $wp_customize->add_setting('menu_link_color', array('default' => '#b79e6f', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_color_ctrl', array('label' => 'Cor dos Links', 'section' => 'veredict_menu_section', 'settings' => 'menu_link_color')));

    $wp_customize->add_setting('menu_link_hover_color', array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_hover_ctrl', array('label' => 'Cor no Hover', 'section' => 'veredict_menu_section', 'settings' => 'menu_link_hover_color')));

    // Seção: Estrutura (Fundo e Bordas)
    $wp_customize->add_section('veredict_header_struct_section', array(
        'title'    => 'Fundo e Bordas',
        'panel'    => 'veredict_header_panel',
    ));

    $wp_customize->add_setting('header_background_color', array('default' => '#070b0e', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_ctrl', array('label' => 'Cor de Fundo', 'section' => 'veredict_header_struct_section', 'settings' => 'header_background_color')));

    // Seção: Botão de Ação
    $wp_customize->add_section('veredict_header_btn_section', array(
        'title'    => 'Botão de Contato',
        'panel'    => 'veredict_header_panel',
    ));

    $wp_customize->add_setting('header_btn_text', array('default' => 'Fale conosco', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('header_btn_text_control', array('label' => 'Texto do Botão', 'section' => 'veredict_header_btn_section', 'settings' => 'header_btn_text'));

    $wp_customize->add_setting('header_btn_url', array('default' => '#', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('header_btn_url_control', array('label' => 'Link do Botão', 'section' => 'veredict_header_btn_section', 'settings' => 'header_btn_url'));


    // ==========================================
    // PAINEL: RODAPÉ (Agrupando tudo)
    // ==========================================
    $wp_customize->add_panel('veredict_footer_panel', array(
        'title'       => 'Configurações do Rodapé',
        'priority'    => 40,
    ));

    // Seção: Conteúdo do Rodapé (Frase e Logo)
    $wp_customize->add_section('veredict_footer_content_section', array(
        'title'    => 'Conteúdo e Branding',
        'panel'    => 'veredict_footer_panel',
    ));

    $wp_customize->add_setting('footer_description', array(
        'default'           => 'Excelência jurídica com foco em resultados estratégicos.',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));
    $wp_customize->add_control('footer_description_ctrl', array(
        'label'    => 'Descrição abaixo da Logo',
        'section'  => 'veredict_footer_content_section',
        'settings' => 'footer_description',
        'type'     => 'textarea',
    ));

    // Seção: Informações de Contato
    $wp_customize->add_section('veredict_footer_contact_section', array(
        'title'    => 'Informações de Contato',
        'panel'    => 'veredict_footer_panel',
    ));

    // Endereço
    $wp_customize->add_setting('footer_address', array('default' => 'Porto Alegre, RS', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('footer_address_ctrl', array('label' => 'Endereço', 'section' => 'veredict_footer_contact_section', 'settings' => 'footer_address'));

    // E-mail
    $wp_customize->add_setting('footer_email', array('default' => 'contato@veredict.com', 'sanitize_callback' => 'sanitize_email'));
    $wp_customize->add_control('footer_email_ctrl', array('label' => 'E-mail', 'section' => 'veredict_footer_contact_section', 'settings' => 'footer_email'));

    // Telefone
    $wp_customize->add_setting('footer_phone', array('default' => '(51) 99999-9999', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('footer_phone_ctrl', array('label' => 'Telefone', 'section' => 'veredict_footer_contact_section', 'settings' => 'footer_phone'));

    // Seção: Cores do Rodapé
    $wp_customize->add_section('veredict_footer_colors_section', array(
        'title'    => 'Cores do Rodapé',
        'panel'    => 'veredict_footer_panel',
    ));

    $wp_customize->add_setting('footer_title_color', array(
        'default'           => '#b79e6f',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_title_color_ctrl', array(
        'label'    => 'Cor dos Títulos',
        'section'  => 'veredict_footer_colors_section',
        'settings' => 'footer_title_color',
    )));

    $wp_customize->add_setting('footer_text_color', array(
        'default'           => 'rgba(255, 255, 255, 0.6)',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_text_color_ctrl', array(
        'label'    => 'Cor do Texto e Links',
        'section'  => 'veredict_footer_colors_section',
        'settings' => 'footer_text_color',
    )));
    $wp_customize->add_setting('footer_background_color', array('default' => '#0d0d0d', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bg_color_ctrl', array('label' => 'Cor de Fundo', 'section' => 'veredict_footer_colors_section', 'settings' => 'footer_background_color')));

    // Seção Principal: Páginas Internas
    $wp_customize->add_section('prestige_theme_options', array(
        'title'    => __('Configurações Páginas Internas', 'veredict'),
        'priority' => 30,
    ));

    // 1. COR DE DESTAQUE (Dourado/Gold)
    $wp_customize->add_setting('prestige_accent_color', array(
        'default'   => '#B79E6F',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'prestige_accent_color', array(
        'label'    => __('Cor de Destaque (Geral Internas)', 'veredict'),
        'section'  => 'prestige_theme_options',
    )));

    // 2. COR DO BADGE (Fundo Preto do Status)
    $wp_customize->add_setting('prestige_badge_bg', array(
        'default'   => '#070B0E',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'prestige_badge_bg', array(
        'label'    => __('Cor de Fundo do Badge', 'veredict'),
        'section'  => 'prestige_theme_options',
    )));

    // 3. ADICIONAIS DE TEXTO (O que você pediu)
    $wp_customize->add_setting('internal_text_home', array('default' => 'Início', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('internal_text_home', array('label' => 'Texto "Início" (Breadcrumb)', 'section' => 'prestige_theme_options'));

    $wp_customize->add_setting('internal_text_share', array('default' => 'Compartilhar:', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('internal_text_share', array('label' => 'Texto "Compartilhar"', 'section' => 'prestige_theme_options'));

    $wp_customize->add_setting('internal_text_sidebar_label', array('default' => 'Leitura Sugerida', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('internal_text_sidebar_label', array('label' => 'Título da Sidebar', 'section' => 'prestige_theme_options'));

    $wp_customize->add_setting('internal_text_inst', array('default' => 'Institucional', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('internal_text_inst', array('label' => 'Texto do Badge (Institucional)', 'section' => 'prestige_theme_options'));

    $wp_customize->add_setting('prestige_sidebar_btn_text', array(
        'default'   => 'Explorar',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('prestige_sidebar_btn_text', array(
        'label'    => __('Texto do Botão (Explorar)', 'veredict'),
        'section'  => 'prestige_theme_options',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'veredict_custom_register');


/**
 * Injeção de CSS Dinâmico no Cabeçalho
 * Recupera os valores salvos no Customizer através da função get_theme_mod
 * e aplica o CSS diretamente no front-end para sobrescrever os estilos base.
 */
function veredict_custom_css()
{
    $btn_main   = get_theme_mod('btn_color_main', '#b79e6f');
    $btn_h_bg   = get_theme_mod('btn_color_hover_bg', '#b79e6f');
    $btn_h_txt  = get_theme_mod('btn_color_hover_text', '#070b0e');
    $menu_color = get_theme_mod('menu_link_color', '#b79e6f');
    $menu_hover = get_theme_mod('menu_link_hover_color', '#ffffff');
    $menu_hover_border_color = get_theme_mod('menu_hover_border_bottom_color', '#b79e6f');
    $header_bg = get_theme_mod('header_background_color', '#070b0e');
    $border_top_color = get_theme_mod('border_top_color', 'rgba(255, 255, 255, 0.05)');
    $border_bottom_color = get_theme_mod('border_bottom_color', 'rgba(255, 255, 255, 0.05)');
    $footer_background_color = get_theme_mod('footer_background_color', '#0D0D0D');
    $footer_title_color = get_theme_mod('footer_title_color', '#b79e6f');
    $footer_text_color  = get_theme_mod('footer_text_color', '#a0a5ad');
    $accent = get_theme_mod('prestige_accent_color', '#B79E6F');
    $badge_bg = get_theme_mod('prestige_badge_bg', '#070B0E');
?>
    <style type="text/css">
        .btn-veredict {
            border-color: <?php echo $btn_main; ?> !important;
            color: <?php echo $btn_main; ?> !important;
        }

        .btn-veredict:hover {
            background-color: <?php echo $btn_h_bg; ?> !important;
            border-color: <?php echo $btn_h_bg; ?> !important;
            color: <?php echo $btn_h_txt; ?> !important;
        }

        #nav-menu ul li a {
            color: <?php echo $menu_color; ?> !important;
        }

        #nav-menu ul li a:hover {
            color: <?php echo $menu_hover; ?> !important;
        }

        #nav-menu ul li a::after {
            background-color: <?php echo $menu_hover_border_color; ?> !important;
        }

        #masthead {
            background-color: <?php echo $header_bg ?> !important;
            border-top: 1px solid <?php echo $border_top_color; ?> !important;
            border-bottom: 1px solid <?php echo $border_bottom_color; ?> !important;
        }

        footer {
            background-color: <?php echo $footer_background_color ?> !important;
        }

        #mastfooter .footer-title {
            color: <?php echo $footer_title_color; ?> !important;
        }

        #mastfooter .footer-description,
        #mastfooter .contact-info li,
        #mastfooter .footer-navigation ul li a {
            color: <?php echo $footer_text_color; ?> !important;
        }

        #mastfooter .footer-navigation ul li a:hover {
            color: #ffffff !important;
        }

        .gold-line,
        .label-line {
            background: <?php echo $accent; ?> !important;
        }

        .badge-status-new {
            background: <?php echo $badge_bg; ?> !important;
            color: <?php echo $accent; ?> !important;
        }

        .prestige-breadcrumbs .current,
        .card-cat,
        .card-btn,
        .card-footer i {
            color: <?php echo $accent; ?> !important;
        }

        .share-minimal:hover,
        .prestige-breadcrumbs a:hover,
        .curated-card:hover .card-title {
            color: <?php echo $accent; ?> !important;
        }

        .sidebar-label {
            color: <?php echo $badge_bg; ?>;
        }
    </style>
<?php
}
add_action('wp_head', 'veredict_custom_css');