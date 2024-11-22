<?php
    
/**
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      04/09/2018
 *
 * @package Neve
 */

$container_class = apply_filters( 'neve_container_class_filter', 'container', 'blog-archive' );

get_header();

$wrapper_classes = [ 'posts-wrapper' ];
$wrapper_classes = apply_filters( 'neve_posts_wrapper_class', $wrapper_classes );

?>
	<div class="<?php echo esc_attr( $container_class ); ?> archive-container">
		<div class="row">
			<?php do_action( 'neve_do_sidebar', 'blog-archive', 'left' ); ?>
			<div class="nv-index-posts search col">
				<?php
				do_action( 'neve_page_header', 'search' );
// Captura o termo de busca
$search_query = get_search_query();

$args = array(
    'post_type' => 'noticia',
    'posts_per_page' => -1, // Trazer todos os posts sem limite de quantidade
    's' => $search_query // Termo de busca
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
            <div class="col" style="max-width: 80%;" >
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

    wp_reset_postdata();
else :
    // Caso não haja posts
    echo 'Nenhum post encontrado para "' . esc_html( $search_query ) . '".';
endif;
?>
<div class="w-100"></div>
</div>
<?php do_action( 'neve_do_sidebar', 'blog-archive', 'right' ); ?>
</div>
</div>
<?php
get_footer();