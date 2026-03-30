<?php get_header(); ?>

<div id="content" class="site-content prestige-archive-page">
    <div class="container-prestige">

        <header class="prestige-header-minimal">
            <span class="prestige-label-top"><?php esc_html_e('Navegando em', 'veredict'); ?></span>
            <h1 class="prestige-page-title">
                <?php
                echo single_term_title('', false);
                ?>
            </h1>
            <?php if (get_the_archive_description()) : ?>
                <div class="prestige-page-subtitle"><?php the_archive_description(); ?></div>
            <?php endif; ?>
        </header>

        <main id="primary" class="modern-feed-container">
            <?php if (have_posts()) : ?>
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
                                    <div class="entry-top-info">
                                        <span class="entry-date"><?php echo get_the_date('d.m.Y'); ?></span>
                                    </div>

                                    <h2 class="entry-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>

                                    <div class="entry-description">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                    </div>

                                    <a href="<?php the_permalink(); ?>" class="prestige-link-gold">
                                        <?php esc_html_e('Ler Artigo', 'veredict'); ?>
                                    </a>
                                </div>
                            </div>
                        </article>

                    <?php endwhile; ?>
                </div>

                <div class="prestige-modern-pagination">
                    <?php echo paginate_links(array('prev_text' => '←', 'next_text' => '→')); ?>
                </div>

            <?php else : ?>
                <p><?php esc_html_e('Nenhum post encontrado nesta categoria.', 'veredict'); ?></p>
            <?php endif; ?>
        </main>
    </div>
</div>

<?php get_footer(); ?>