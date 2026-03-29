<?php get_header(); ?>

<div id="content" class="site-content prestige-single-clean">
    <div class="container-prestige-narrow">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('prestige-post-full'); ?>>

                    <nav class="prestige-breadcrumbs-alt" aria-label="Breadcrumb">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php echo esc_html(get_theme_mod('internal_text_home', __('Início', 'veredict'))); ?>
                        </a>
                        <span class="sep" aria-hidden="true">/</span>
                        <span class="current"><?php the_title(); ?></span>
                    </nav>

                    <header class="post-header-center">
                        <div class="post-meta-top">
                            <span class="post-cat-badge">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo esc_html($categories[0]->name);
                                } else {
                                    esc_html_e('Informativo', 'veredict');
                                }
                                ?>
                            </span>
                            <time class="post-date" datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </div>

                        <h1 class="post-main-title"><?php the_title(); ?></h1>

                        <div class="post-intro-divider">
                            <span class="gold-dot"></span>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-featured-wrapper">
                            <?php the_post_thumbnail('full', array('alt' => get_the_title())); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-entry-content">
                        <?php
                        the_content();
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Páginas:', 'veredict'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <footer class="post-footer-editorial">
                        <?php edit_post_link(esc_html__('Editar Post', 'veredict'), '<div class="edit-post-wrapper">', '</div>'); ?>

                        <div class="nav-links-prestige">
                            <div class="nav-item prev-post">
                                <?php $prev_post = get_previous_post();
                                if (!empty($prev_post)) : ?>
                                    <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                                        <span class="nav-label">
                                            <?php echo esc_html(get_theme_mod('prestige_label_prev', __('Anterior', 'veredict'))); ?>
                                        </span>
                                        <h4 class="nav-post-name"><?php echo esc_html($prev_post->post_title); ?></h4>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <div class="nav-central-divider"></div>

                            <div class="nav-item next-post">
                                <?php $next_post = get_next_post();
                                if (!empty($next_post)) : ?>
                                    <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                                        <span class="nav-label">
                                            <?php echo esc_html(get_theme_mod('prestige_label_next', __('Próximo', 'veredict'))); ?>
                                        </span>
                                        <h4 class="nav-post-name"><?php echo esc_html($next_post->post_title); ?></h4>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (comments_open() || get_comments_number()) : ?>
                            <div class="post-comments-section">
                                <?php comments_template(); ?>
                            </div>
                        <?php endif; ?>
                    </footer>

                </article>

        <?php endwhile;
        endif; ?>
    </div>
</div>

<?php get_footer(); ?>