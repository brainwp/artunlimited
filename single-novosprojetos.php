<?php 
if (!is_user_logged_in()) {
	header( 'Location: '.get_home_url( ) ) ; 
	die();
}
	global $current_user, $wpdb;
	$role = $wpdb->prefix . 'capabilities';
	$current_user->role = array_keys($current_user->$role);

	$role = $current_user->role[0];
	
if ( $role != 'parceiro' AND $role!= "administrator" AND $role!='editor' ) {
	header( 'Location: '.get_home_url( ) ) ; 
	die();

	} 
?>
<?php
/**
 * The Template for displaying all single posts.
 * @package artunlimited
 */

get_header( 'novosprojetos' ); ?>

	<div class="content-single-portfolio">
		<div id="content-interno" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

        
	<div class="esquerda-single-portfolio">

		<header class="entry-header">
			<h1 class="entry-title-interno"><?php the_title(); ?></h1>

			<?php
				// Pega os dados e salva em variáveis
                $metanovosprojetos_2alinhatitulo = get_post_meta($post->ID,'metanovosprojetos_2alinhatitulo',TRUE);
				?>
		
				<?php if (empty($metanovosprojetos_2alinhatitulo)) {
                } else { ?>
              <h1 class="entry-title-interno"><?php echo $metanovosprojetos_2alinhatitulo; ?></h1>
			<?php } ?>
			
			    <?php
				// Pega os dados e salva em variáveis
                $metanovosprojetos_subtitulo = get_post_meta($post->ID,'metanovosprojetos_subtitulo',TRUE);
				?>
				<?php if (empty($metanovosprojetos_subtitulo)) {
                } else { ?>
				<h3 class="entry-sub-title-interno"><?php echo $metanovosprojetos_subtitulo; ?></h3>
				<?php }	?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'artunlimited' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
				
				<?php // artunlimited_content_nav( 'nav-below' ); ?>
				<?php endwhile; // end of the loop. ?>
				
				<?php wp_reset_query(); // reset query ?>
	</div>
			<!-- .esquerda-single-portfolio -->
			<div class="direita-single-portfolio">
			<?php get_sidebar( 'novosprojetos' ); ?>
			</div><!-- #direita-single-portfolio -->
			
		</div><!-- #content -->
		
			            <div class="clearfix">
						</div>

<?php get_footer( 'portfolio' ); ?>

	</div><!-- #content-single-portfolio -->
	

