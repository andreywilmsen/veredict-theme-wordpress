<?php get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                // Exibe o título da página
                echo '<h1 class="page-title">' . get_the_title() . '</h1>';
                
                // Exibe o que você escreveu no editor do WP
                the_content();
            endwhile;
        else :
            echo '<p>Nenhum conteúdo encontrado para esta página.</p>';
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>