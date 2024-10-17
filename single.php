<?php
/**
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      28/08/2018
 *
 * @package Neve
 */

$container_class = apply_filters( 'neve_container_class_filter', 'container', 'single-post' );

get_header();

?>
	<div class="<?php echo esc_attr( $container_class ); ?> single-post-container">
		<div class="row">
			<?php do_action( 'neve_do_sidebar', 'single-post', 'left' ); ?>
			<article id="post-<?php echo esc_attr( get_the_ID() ); ?>"
					class="<?php echo esc_attr( join( ' ', get_post_class( 'nv-single-post-wrap col' ) ) ); ?>">
				
						
					<div class="entry-header" style="padding-bottom:0px;margin-bottom:0px;">
					<div class="nv-title-meta-wrap" style="">
					<h1 class="title entry-title"> <?php echo the_title(); ?> </h1>
					<div class="post-meta" style="font-size: 0.9em;padding-bottom:30px;">
					<?php echo get_the_date('j \d\e F \d\e Y'); ?> /
					<?php the_category(', '); ?> / <?php the_category_ID(); ?>
					</div>
					</div>
						<?php if ( get_field('subtitulo') ) : ?>
							<h3 style="font-style: italic"> <?php echo get_field('subtitulo'); ?> </h3>	
						<?php endif; ?>
					</div>
		
				
				<?php
				/**
				 *  Executes actions before the post content.
				 *
				 * @since 2.3.8
				 */
				do_action( 'neve_before_post_content' );

				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content', 'single' );
					}
				} else {
					get_template_part( 'template-parts/content', 'none' );
				}

				/**
				 *  Executes actions after the post content.
				 *
				 * @since 2.3.8
				 */
				do_action( 'neve_after_post_content' );
				?>
			</article>
			<?php do_action( 'neve_do_sidebar', 'single-post', 'right' ); ?>
		</div>
	</div>
<?php
get_footer();
