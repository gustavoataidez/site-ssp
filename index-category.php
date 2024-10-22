<?php
/**
 * Index template.
 *
 * @package Neve
 */

/**
 * Filters the container classes.
 *
 * @param string $classes Container classes.
 *
 * @since 1.0.0
 */
$container_class = apply_filters( 'neve_container_class_filter', 'container', 'blog-archive' );

get_header();

$wrapper_classes = [ 'posts-wrapper' ];
$wrapper_classes = apply_filters( 'neve_posts_wrapper_class', $wrapper_classes );

$load_before_after_hooks = get_theme_mod( 'neve_blog_archive_layout', 'grid' ) === 'default';

?>
	<div class="<?php echo esc_attr( $container_class ); ?> archive-container">

		<?php
		/**
		 * Executes the rendering function for the featured post.
		 *
		 * @since 3.2
		 */
		do_action( 'neve_do_featured_post', 'index' );
		?>

		<div class="row">
			
			<?php
			/**
			 * Executes the rendering function for the sidebar.
			 *
			 * @param string $context Sidebar context.
			 * @param string $position Sidebar position.
			 *
			 * @since 1.0.0
			 */
			do_action( 'neve_do_sidebar', 'blog-archive', 'left' );
			?>
			<div class="nv-index-posts blog col">
				
				
				
				
				
				<?php
				/**
				 * Executes actions before the posts loop start.
				 *
				 * @since 2.4.0
				 */
				do_action( 'neve_before_loop' );

				/**
				 * Executes the rendering function for the page header.
				 *
				 * @param string $context Header display page.
				 *
				 * @since 2.3.10
				 */
				do_action( 'neve_page_header', 'index' );

				/**
				 * Executes actions before the post loop.
				 *
				 * @since 2.3.10
				 */
				
				do_action( 'neve_before_posts_loop' );


				if ( have_posts() ) {
					
					/* Start the Loop. */
					echo '<div class="' . esc_attr( join( ' ', $wrapper_classes ) ) . '">';


					$pagination_type = get_theme_mod( 'neve_pagination_type', 'number' );
					if ( $pagination_type !== 'infinite' ) {
						global $wp_query;

						$posts_on_current_page = $wp_query->post_count;
						$hook_after_post       = -1;

						if ( $posts_on_current_page >= 2 ) {
							$hook_after_post = (int) ceil( $posts_on_current_page / 2 );
						}
						$post_index = 1;
					}

					neve_do_loop_hook( 'before' );

					/**
					 * Exclude posts from the main loop
					 *
					 * @param array $excluded_posts Excluded post ids.
					 * @since 3.2
					 */
					$excluded_posts = apply_filters( 'nv_exclude_posts', [] );

					while ( have_posts() ) {
						the_post();

						$pid = get_the_ID();
						if ( in_array( $pid, $excluded_posts, true ) ) {
							continue;
						}

						neve_do_loop_hook( 'entry_before' );

						if ( $load_before_after_hooks ) {
							/**
							 * Executes actions before rendering the post content.
							 *
							 * @since 2.11
							 */
							do_action( 'neve_loop_entry_before' );
						}

						get_template_part( 'template-parts/content', get_post_type() );

						if ( $load_before_after_hooks ) {
							/**
							 * Executes actions after rendering the post content.
							 *
							 * @since 2.11
							 */
							do_action( 'neve_loop_entry_after' );
						}

						if ( $pagination_type !== 'infinite' && $load_before_after_hooks ) {
							if ( $post_index === $hook_after_post && $hook_after_post !== - 1 ) {
								/**
								 * Executes actions in the middle of the loop.
								 *
								 * The actions only fires if the pagination is not set as "infinite scroll".
								 *
								 * @since 2.3.10
								 */
								do_action( 'neve_middle_posts_loop' );
							}
							$post_index ++;
						}

						neve_do_loop_hook( 'entry_after' );
					}
					echo '</div>';
					if ( ! is_singular() ) {
						/**
						 * Executes the rendering function for the pagination.
						 *
						 * @param string $context Pagination location context.
						 */
						do_action( 'neve_do_pagination', 'blog-archive' );
					}
				} else {
					get_template_part( 'template-parts/content', 'none' );
				}
				?>
				<div class="w-100"></div>
				
<div id="primary" class="content-area">
    <div class="site-main">
				

	<?php
// Obter a categoria atual da página
$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;

// Definir parâmetros para a query, incluindo o ID da categoria atual
$args = array(
    'post_type'      => 'noticia',
    'posts_per_page' => 10, // Número de posts por página
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1, // Página atual
    'cat'            => $cat_id // Filtrar pela categoria atual
);

$custom_query = new WP_Query( $args );

if ( $custom_query->have_posts() ) :

    // Loop para exibir os posts personalizados
    while ( $custom_query->have_posts() ) : $custom_query->the_post();
        
        // Obter a primeira categoria do post
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            $first_category_id = $categories[0]->term_id; // ID da primeira categoria
        } else {
            $first_category_id = ''; // Caso não tenha categoria, define como vazio
        }

        // Verificar se o ID da primeira categoria do post é igual ao ID da categoria da página
        if ( $cat_id === $first_category_id ) :
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
                </div>
            </a>

            <?php
        endif; // Fim da verificação de categoria

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


</div>
</div>
				
				
				
				
				<?php
				/**
				 * Executes actions after the post loop.
				 *
				 * @since 2.3.10
				 */
				do_action( 'neve_after_posts_loop' );

				neve_do_loop_hook( 'after' );
				?>
			</div>
			<?php
			do_action( 'neve_do_sidebar', 'blog-archive', 'right' );
			?>
		</div>
	</div>
<?php
get_footer();
