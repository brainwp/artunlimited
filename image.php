<?php
/**
 * The template for displaying image attachments.
 *
 * @package artunlimited
 */
get_header( 'sem-aba' );
?>
<div class="content-image">
	<div id="content-interno" class="site-content" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<nav role="navigation" id="image-navigation" class="navigation-image">
						<div class="get-back">
								<?php
									$metadata = wp_get_attachment_metadata();
									printf( __( '<span class="entry-date">Voltar para: <a href="%1$s" title="Voltar para %2$s" rel="gallery">%3$s</a></span>', 'artunlimited' ),
										esc_url( get_permalink( $post->post_parent ) ),
										esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
										get_the_title( $post->post_parent )
									);
								?>
						</div>
						<div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Anterior', 'artunlimited' ) ); ?></div>
						<div class="nav-next"><?php next_image_link( false, __( 'Próximo <span class="meta-nav">&rarr;</span>', 'artunlimited' ) ); ?></div>
					</nav><!-- #image-navigation -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="entry-attachment">
						<div class="attachment">
							<?php artunlimited_the_attached_image(); ?>
						</div><!-- .attachment -->

						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
						<?php endif; ?>
					</div><!-- .entry-attachment -->

					<?php
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'artunlimited' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

			</article><!-- #post-## -->

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->

	<div class="clearfix">
	</div>


	<?php get_footer( 'portfolio' ); ?>

</div><!-- #content-single-portfolio -->