<?php get_header(); ?>

<div id="content" class="site-content prestige-blog-clean">
    <div class="container-prestige">

        <header class="prestige-header-minimal">
            <h1 class="prestige-page-title"><?php single_post_title(); ?></h1>
            <div class="prestige-page-subtitle">
                <?php
                // Puxa o texto do Customizer ou usa o padrão
                echo esc_html(get_theme_mod('blog_subtitle_text', 'Análises e perspectivas estratégicas.'));
                ?>
            </div>
        </header>

        <main id="primary" class="modern-feed-container">
            <?php if (have_posts()) : ?>
                <div class="prestige-modern-list">
                    <?php while (have_posts()) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('modern-entry'); ?>>
                            <div class="entry-wrapper">

                                <div class="entry-image-box">
                                    <a href="<?php the_permalink(); ?>" class="image-hover-zoom">
                                        <?php if (has_post_thumbnail()) :
                                            the_post_thumbnail('large');
                                        else : ?>
                                            <div class="prestige-placeholder-light"></div>
                                        <?php endif; ?>
                                    </a>
                                </div>

                                <div class="entry-content-box">
                                    <div class="entry-top-info">
                                        <span class="entry-category">
                                            <?php $cats = get_the_category();
                                            echo !empty($cats) ? esc_html($cats[0]->name) : 'Geral'; ?>
                                        </span>
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

            <?php endif; ?>
        </main>
    </div>
</div>

<?php get_footer(); ?>