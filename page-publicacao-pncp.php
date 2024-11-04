<?php
/*
Template Name: Publicação-PNCP
*/

get_header();

?>
<!-- <H2>Publicação - Cotações</H2> -->
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    // Definir parâmetros para a query
    $args = array(
        'post_type' => 'PNCP',
        'posts_per_page' => 5, // Número de posts por página
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1, // Página atual
        // Adicionar parâmetros para filtrar por taxonomia 'boletim-mensal'
        
    );





    $custom_query = new WP_Query( $args );
    
    if ( $custom_query->have_posts() ) :
        // Loop para exibir os posts personalizados
        while ( $custom_query->have_posts() ) : $custom_query->the_post();
            ?>
            
            <div class="custom-post-card">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>
                <?php endif; ?>
                <div class="post-content">
                    <div class="entry-meta">
                        <?php
                        // Exibir categoria com estilo azul
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                           echo '<span class="category">' . esc_html( $categories[0]->name ) . '</span>';
                        }
                        ?>
                        <!-- <span class="post-date"><?php echo get_the_date(); ?></span> -->
                        
                    </div>
                    
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-content -->
                            
                    <?php 
                            $link = get_field('link');
							$descricao = get_field('descricao');
                            $file_icon = '../wp-content/uploads/2024/11/exportar1-1-2.png';
                            echo '<a href="'.$link.'" target="_blank"><img src="' . $file_icon . '" alt=""/> - <H3>'.$descricao.'</H3></a><BR>';
                                
                      ?>
                </div><!-- .post-content -->
            </div><!-- .custom-post-card -->
            
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