<?php
/*
Template Name: boletim-mensal
*/
get_header();

?>
<!-- <H2>Estatística - Boletins Mensais</H2> -->
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php
    // Definir parâmetros para a query
    $args = array(
        'post_type' => 'estatistica',
        'posts_per_page' => 5, // Número de posts por página
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1, // Página atual
        // Adicionar parâmetros para filtrar por taxonomia 'boletim-mensal'
        'tax_query' => array(
            array(
                'taxonomy' => 'estatistica',
                'field'    => 'slug', // Pode ser 'term_id', 'name', ou 'slug'
                'terms'    => 'boletim-mensal', // Substitua pelo slug da sua categoria
            ),
        ),
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
                           // echo '<span class="category">' . esc_html( $categories[0]->name ) . '</span>';
                        }
                        ?>
                        <!-- <span class="post-date"><?php echo get_the_date(); ?></span> -->
                        
                    </div>
                    <!-- <h2 class="entry-title"><?php //the_title(); ?></h2> -->
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-content -->
                            
                    <?php
                        // Verifica se existem anexos
                        $attachments = get_posts(array(
                            'post_type' => 'attachment',
                            'posts_per_page' => -1,
                            'post_parent' => $post->ID
                        ));

                        if ($attachments) {
                            foreach ($attachments as $attachment) {
                                $attachment_url = wp_get_attachment_url($attachment->ID);
                                //$attachment_title = apply_filters('the_title', $attachment->post_title);
                                $file_type = wp_check_filetype($attachment_url);
                                $file_icon = '';

                                if ($file_type['ext'] === 'pdf') {
                                    // Ícone para arquivos PDF
                                    $file_icon = '../wp-content/uploads/2024/04/pdf.png';
                                } else {
                                    // Ícone padrão para outros tipos de arquivo
                                    $file_icon = wp_mime_type_icon($file_type['type']);
                                }

                                echo '<div class="attachment">';
                                echo '<a class="entry-title" href="' . $attachment_url . '">';
                                echo '<img src="' . $file_icon . '" alt="' . esc_attr($attachment_title) . '" width="32" height="32" /> - ';
                                echo '<h2 class="entry-title">  ' .the_title() .'</h2>';
                                echo '</a>';
                                // Adiciona um botão de download
                                //echo '<a href="' . $attachment_url . '" class="button">Download</a>';
                                echo '</div>';
                            }
                        }
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