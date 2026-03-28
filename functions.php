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
    // Menu principal (topo)

    $wp_customize->add_section('veredict_menu_section', array(
        'title'    => 'Cores do Menu',
        'priority' => 31,
    ));

    $wp_customize->add_setting('menu_link_color', array(
        'default'           => '#b79e6f',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_color_ctrl', array(
        'label'    => 'Cor dos Links',
        'section'  => 'veredict_menu_section',
        'settings' => 'menu_link_color',
    )));

    $wp_customize->add_setting('menu_link_hover_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_hover_ctrl', array(
        'label'    => 'Cor no Hover (Passar o Mouse)',
        'section'  => 'veredict_menu_section',
        'settings' => 'menu_link_hover_color',
    )));
    $wp_customize->add_setting('menu_hover_border_bottom_color', array(
        'default' => '#b79e6f',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_link_hover_border_ctrl', array(
        'label'    => 'Cor da borda (Passar o Mouse)',
        'section'  => 'veredict_menu_section',
        'settings' => 'menu_hover_border_bottom_color',
    )));

    // Botão de fale conosco

    $wp_customize->add_section('veredict_header_btn_section', array(
        'title'    => 'Botão do Cabeçalho',
        'priority' => 40,
    ));

    $wp_customize->add_setting('header_btn_text', array('default' => 'Fale conosco', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('header_btn_text_control', array('label' => 'Texto do Botão', 'section' => 'veredict_header_btn_section', 'settings' => 'header_btn_text'));

    $wp_customize->add_setting('header_btn_url', array('default' => '#', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('header_btn_url_control', array('label' => 'Link do Botão', 'section' => 'veredict_header_btn_section', 'settings' => 'header_btn_url'));

    $wp_customize->add_setting('btn_color_main', array('default' => '#b79e6f', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'btn_color_main_ctrl', array(
        'label' => 'Cor Principal (Borda e Texto)',
        'section' => 'veredict_header_btn_section',
        'settings' => 'btn_color_main',
    )));

    $wp_customize->add_setting('btn_color_hover_bg', array('default' => '#b79e6f', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'btn_color_hover_bg_ctrl', array(
        'label' => 'Cor de Fundo no Hover',
        'section' => 'veredict_header_btn_section',
        'settings' => 'btn_color_hover_bg',
    )));

    $wp_customize->add_setting('btn_color_hover_text', array('default' => '#070b0e', 'sanitize_callback' => 'sanitize_hex_color'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'btn_color_hover_text_ctrl', array(
        'label' => 'Cor do Texto no Hover',
        'section' => 'veredict_header_btn_section',
        'settings' => 'btn_color_hover_text',
    )));

    // Background

    $wp_customize->add_section('veredict_header_background_color_section', array(
        'title' => 'Cor de fundo',
        'priority' => 41
    ));

    $wp_customize->add_setting('header_background_color', array(
        'default' => '#070b0e',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_color_control', array(
        'label' => 'Cor de fundo',
        'section' => 'veredict_header_background_color_section',
        'settings' => 'header_background_color'
    )));

    // Bordas

    $wp_customize->add_section('veredict_header_border_color_section', array(
        'title' => 'Cor da borda',
        'priority' => 42
    ));
    $wp_customize->add_setting('border_top_color', array(
        'default' => '#b79e6fd3',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_setting('border_bottom_color', array(
        'default' => '#b79e6fd3',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(new WP_Customize_Color_control($wp_customize, 'top_color_control', array(
        'label' => 'Cor da borda superior',
        'section' => 'veredict_header_border_color_section',
        'settings' => 'border_top_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_control($wp_customize, 'bottom_color_control', array(
        'label' => 'Cor da borda inferior',
        'section' => 'veredict_header_border_color_section',
        'settings' => 'border_bottom_color'
    )));
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
    $border_top_color = get_theme_mod('border_top_color', '#b79e6fd3');
    $border_bottom_color = get_theme_mod('border_bottom_color', '#b79e6fd3');
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
            border-top: 2px solid <?php echo $border_top_color; ?> !important;
            border-bottom: 2px solid <?php echo $border_bottom_color; ?> !important;
        }
    </style>
<?php
}
add_action('wp_head', 'veredict_custom_css');
