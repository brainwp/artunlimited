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
						<div class="get-back"><a href="#" onClick="window.history.back()">Voltar</a></div>
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