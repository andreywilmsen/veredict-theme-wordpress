<?php get_header(); ?>

<div id="content" class="site-content prestige-404-clean">
    <div class="container-prestige-narrow">
        <section class="error-404-content">
            <span class="error-code">404</span>
            <h1 class="prestige-page-title"><?php esc_html_e('Página Não Encontrada', 'veredict'); ?></h1>
            <p class="error-text">
                <?php esc_html_e('O conteúdo que você está procurando foi movido, removido ou nunca existiu. Verifique a URL ou use a busca abaixo.', 'veredict'); ?>
            </p>

            <div class="error-search-wrapper">
                <?php get_search_form(); ?>
            </div>

            <a href="<?php echo esc_url(home_url('/')); ?>" class="prestige-btn-dark">
                <?php esc_html_e('Voltar para o Início', 'veredict'); ?>
            </a>
        </section>
    </div>
</div>

<?php get_footer(); ?>