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

53,107,155,87,127,69,56,110,114,125,73,64,63,99,59,164,93,89,38,208,19,101,193,116,54,170,104,18,129,75,23,177,141,200,124,179,24,201,79,134,52,102,70,142,138,105,204,60,175,121,26,86,81,29,100,173,174,169,76,150,143,58,57,145,166,152,139,74,37,44,46,42,68,90,144,178,85,113,30,171,167,207,206,205,83,149,180,98,108,168,33,72,130,126,146,132,182,181,88,131,1,157,122,172,51,47,118,27,176,153,154,49

[1,18,19,23,24,26,27,29,30,33,37,38,42,44,46,47,49,51,52,53,54,56,57,58,59,60,63,64,68,69,70,72,73,74,75,76,79,81,83,85,86,87,88,89,90,93,98,99,100,101,102,104,105,107,108,110,113,114,116,118,121,122,124,125,126,127,129,130,131,132,134,138,139,141,142,143,144,145,146,149,150,152,153,154,155,157,164,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,193,200,201,209]

