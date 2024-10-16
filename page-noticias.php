<?php
/*
Template Name: Noticias
*/
get_header();

?>
<!-- <H2>NOTÍCIAS</H2> -->
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    // Definir parâmetros para a query
    $args = array(
        'post_type' => 'noticia',
        'posts_per_page' => 10, // Número de posts por página
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1 // Página atual
    );
    $custom_query = new WP_Query( $args );
    
    if ( $custom_query->have_posts() ) :
        // Loop para exibir os posts personalizados
        while ( $custom_query->have_posts() ) : $custom_query->the_post();
            ?>

                            
            <!-- POST NOVO -->
            <a href="<?php the_permalink(); ?>" >
				
             <div class="container">
              <div class="row">
                <div class="col">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>
                <?php endif; ?>
                </div>
                <div class="col">
                  <div class="post-content">
                    <div class="entry-meta">
                        
                        <?php
                        // Exibir categoria com estilo azul
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo '<span class="category" id="categoria_noticia">' . esc_html( $categories[0]->name ) . '</span>';
                        }
                        ?>
                        <span class="post-date"><?php echo get_the_date(); ?></span>
                    </div>
                    <h3 class="entry-title"><?php the_title(); ?></h3>
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-content -->
                </div><!-- .post-content -->
                </div>
              </div>
               </a>
            </div>
            <?php
                            
        endwhile;

        // Paginação
        $big = 999999999; // valor alto o suficiente para garantir que a saída da paginação seja formatada corretamente
        echo '<div class="pagination-wrapper">';
        echo paginate_links( array(
            'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'  => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total'   => $custom_query->max_num_pages
        ) );
        echo '</div>';
		
        wp_reset_postdata();
    else :
        // Caso não haja posts
        echo 'Nenhum post encontrado.';
    endif;
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();