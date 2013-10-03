<?php
/**
 * The Template for displaying all single posts.
 *
 * @package artunlimited
 */
get_header(); ?>

	<div id="primary" class="content-area">

		<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<h1 class="titulo-noticias"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>



		<div class="entry-meta">

			<?php echo get_the_date(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

					<div class="full-thumb">

						<?php the_post_thumbnail ( 'full' ); ?>

					</div><!-- .full-thumb -->

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->



	<footer class="entry-meta">

		<?php edit_post_link( __( 'Edit', 'artunlimited' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-meta -->

</article><!-- #post-## -->


			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>
		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->

	</div><!-- #primary -->

<?php get_footer(); ?>