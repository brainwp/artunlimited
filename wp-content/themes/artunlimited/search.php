<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package artunlimited
 */

get_header( 'interno' ); ?>

<div class="altura-header"></div>
	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>
            
            <header class="entry-header-page-404">
                <div class="seta-page"></div>
                <div class="titulo-page"><h1><?php printf( __( 'Search Results for: %s', 'artunlimited' ), '<span>' . get_search_query() . '</span>' ); ?></h1></div>
            </header><!-- .entry-header-page-404 -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php artunlimited_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer( 'noticias' ); ?>