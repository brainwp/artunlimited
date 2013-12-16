<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package artunlimited
 */

get_header( 'interno' ); ?>

<div class="altura-header"></div>

<div id="content-index" class="site-content" role="main">

	<div id="primary" class="content">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
                    <div class="seta-noticias"></div>
					
                    <header class="entry-header-noticias">

						<h1 class="titulo-noticias"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

							<?php if ( 'post' == get_post_type() ) : ?>

						<div class="entry-meta">

							<?php echo get_the_date(); ?>

						</div><!-- .entry-meta -->

						<?php endif; ?>

					</header><!-- .entry-header -->

					<div class="clear"></div>
						

					<!-- <div class="full-thumb">

						<?php // the_post_thumbnail ( 'full' ); ?>

					</div> -->

					<?php if ( is_search() ) : // Only display Excerpts for Search ?>

					<div class="entry-summary">

						<?php the_excerpt(); ?>

					</div><!-- .entry-summary -->

					<?php else : ?>

					<div class="entry-content">

						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'artunlimited' ) ); ?>

					</div><!-- .entry-content -->

					<?php endif; ?>

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'artunlimited' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->

				</article><!-- #post-## -->

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>

</div><!-- #content -->

<?php get_footer( 'noticias' ); ?>
