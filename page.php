<?php get_header(); ?>

<div id="content" class="site-content">
    <div class="container-prestige">

        <nav class="prestige-breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumb', 'veredict'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(get_theme_mod('internal_text_home', 'Início')); ?></a>

            <?php if (is_single()) :
                $cats = get_the_category();
                if ($cats) : ?>
                    <span class="sep">/</span>
                    <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>"><?php echo esc_html($cats[0]->name); ?></a>
                <?php endif; ?>
            <?php endif; ?>

            <span class="sep">/</span>
            <span class="current" aria-current="page"><?php the_title(); ?></span>
        </nav>

        <div class="prestige-layout-grid">

            <main id="primary" class="content-area-prestige">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('prestige-entry'); ?>>

                            <header class="prestige-header">
                                <div class="prestige-meta-bar">
                                    <div class="meta-left">
                                        <span class="badge-status-new">
                                            <?php
                                            if (is_page()) {
                                                echo esc_html(get_theme_mod('internal_text_inst', 'Institucional'));
                                            } else {
                                                $categories = get_the_category();
                                                echo !empty($categories) ? esc_html($categories[0]->name) : esc_html__('Informativo', 'veredict');
                                            }
                                            ?>
                                        </span>
                                        <span class="meta-date"><?php echo get_the_date(); ?></span>
                                        <span class="meta-reading"><?php echo esc_html(get_theme_mod('prestige_reading_time', '5 min read')); ?></span>
                                    </div>

                                    <div class="meta-right-share">
                                        <span class="share-text"><?php echo esc_html(get_theme_mod('internal_text_share', 'Compartilhar:')); ?></span>
                                        <div class="share-icons-group">
                                            <?php
                                            $share_url   = urlencode(get_permalink());
                                            $share_title = urlencode(get_the_title());
                                            ?>
                                            <a href="<?php echo esc_url('https://www.linkedin.com/shareArticle?url=' . $share_url); ?>" target="_blank" rel="noopener" class="share-minimal" title="<?php esc_attr_e('Compartilhar no LinkedIn', 'veredict'); ?>"><i class="dashicons dashicons-linkedin"></i></a>
                                            <a href="<?php echo esc_url('https://api.whatsapp.com/send?text=' . $share_title . '%20' . $share_url); ?>" target="_blank" rel="noopener" class="share-minimal" title="<?php esc_attr_e('Compartilhar no WhatsApp', 'veredict'); ?>"><i class="dashicons dashicons-whatsapp"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <h1 class="prestige-title"><?php the_title(); ?></h1>

                                <div class="prestige-divider">
                                    <span class="gold-line"></span>
                                    <div class="thin-line-ext"></div>
                                </div>
                            </header>

                            <div class="prestige-content">
                                <?php
                                the_content();

                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . esc_html__('Páginas:', 'veredict'),
                                    'after'  => '</div>',
                                ));
                                ?>
                            </div>

                        </article>
                <?php endwhile;
                endif; ?>
            </main>

            <aside class="sidebar-prestige" role="complementary" aria-label="<?php esc_attr_e('Barra Lateral', 'veredict'); ?>">
                <div class="sidebar-sticky">
                    <div class="sidebar-header-modern">
                        <h3 class="sidebar-label"><?php echo esc_html(get_theme_mod('internal_text_sidebar_label', 'Leitura Sugerida')); ?></h3>
                        <div class="label-line"></div>
                    </div>

                    <div class="curated-stack">
                        <?php
                        $recent = new WP_Query(array(
                            'posts_per_page'      => 3,
                            'post__not_in'        => array(get_the_ID()),
                            'ignore_sticky_posts' => 1
                        ));
                        if ($recent->have_posts()) : while ($recent->have_posts()) : $recent->the_post(); ?>

                                <a href="<?php the_permalink(); ?>" class="curated-card" title="<?php the_title_attribute(); ?>">
                                    <div class="card-image">
                                        <?php if (has_post_thumbnail()) :
                                            the_post_thumbnail('medium_large');
                                        else : ?>
                                            <div class="card-placeholder"></div>
                                        <?php endif; ?>
                                        <div class="card-overlay"></div>
                                    </div>

                                    <div class="card-content">
                                        <div class="card-top">
                                            <span class="card-cat">
                                                <?php
                                                $c = get_the_category();
                                                echo !empty($c) ? esc_html($c[0]->name) : esc_html__('Geral', 'veredict');
                                                ?>
                                            </span>
                                            <span class="card-date"><?php echo get_the_date('Y'); ?></span>
                                        </div>
                                        <h4 class="card-title"><?php the_title(); ?></h4>
                                        <div class="card-footer">
                                            <span class="card-btn"><?php echo esc_html(get_theme_mod('prestige_sidebar_btn_text', 'Explorar')); ?></span>
                                            <i class="dashicons dashicons-arrow-right-alt2"></i>
                                        </div>
                                    </div>
                                </a>

                        <?php endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p class="no-content">' . esc_html__('Nenhuma sugestão disponível.', 'veredict') . '</p>';
                        endif; ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<?php get_footer(); ?>