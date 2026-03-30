<?php get_header(); ?>

<div id="content" class="site-content prestige-404-clean prestige-search-page">
    <div class="container-prestige-narrow">
        <section class="error-404-content">
            <span class="error-code">SEARCH</span>

            <h1 class="prestige-page-title">
                <?php printf(esc_html__('Resultados para: %s', 'veredict'), '<span>' . get_search_query() . '</span>'); ?>
            </h1>

            <?php if (! have_posts()) : ?>
                <p class="error-text">
                    <?php esc_html_e('Lamentamos, mas não encontramos nada para sua busca. Tente palavras-chave diferentes.', 'veredict'); ?>
                </p>
                <div class="error-search-wrapper">
                    <?php get_search_form(); ?>
                </div>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="prestige-btn-dark">
                    <?php esc_html_e('Voltar para o Início', 'veredict'); ?>
                </a>
            <?php else : ?>
                <div class="error-search-wrapper" style="margin-bottom: 80px;">
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
        </section>

        <?php if (have_posts()) : ?>
            <main id="primary" class="modern-feed-container">
                <div class="prestige-modern-list">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('modern-entry'); ?>>
                            <div class="entry-wrapper">
                                <div class="entry-image-box">
                                    <a href="<?php the_permalink(); ?>" class="image-hover-zoom">
                                        <?php if (has_post_thumbnail()) : the_post_thumbnail('large');
                                        else : ?>
                                            <div class="prestige-placeholder-light"></div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="entry-content-box">
                                    <h2 class="entry-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="entry-description"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></div>
                                    <a href="<?php the_permalink(); ?>" class="prestige-link-gold"><?php esc_html_e('Ver Resultado', 'veredict'); ?></a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php the_posts_pagination(); ?>
            </main>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>