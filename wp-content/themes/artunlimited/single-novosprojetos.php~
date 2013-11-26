<?php
/**
 * The Template for displaying all single posts.
 * @package artunlimited
 */

get_header( 'portfolio' ); ?>

	<div id="primary" class="content-single-portfolio">
		<div id="content-interno" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

		<div id="slider-portfolio">
                
				<div id="carousel_wrap">
								<a class="prev" id="prev2" href="#"><span>anterior</span></a>
								<a class="next" id="next2" href="#"><span>seguinte</span></a>
							<ul id="carousel">
								<?php
							$args = array(
									'post_type' => 'attachment',
									'numberposts' => -1,
									'post_status' => null,
									'post_parent' => $post->ID,
									'order' => 'ASC',
									'orderby' => 'menu_order'
									);
								
								$anexos = get_posts ( $args );
								
								if ( $anexos ) {
									foreach ( $anexos as $anexo ) { ?>
									
									<?php 
										$attachment_id = $anexo->ID;
										$image_attributes = wp_get_attachment_image_src( $attachment_id, 'projetos' );
										$attachment_page = get_attachment_link( $attachment_id ); 
										$description = $anexo->post_content;
										$url = wp_get_attachment_url( $attachment_id ); 
										?>
								<li>
								<div class="cada-slides">                        
									<?php
									if ($description):
									echo '<div id="desc-slide">' . $description . '</div>';
									endif;
									?>
									<img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo apply_filters('the_title', $anexo->post_title); ?>">
								</div>
								</li>
								<?php } } ?>
							</ul>				
						
                        <div class="clearfix">
						</div>
                
				</div><!-- carousel_wrap -->
		</div><!-- #sider-projetos -->
		
		        <?php
				// Pega os dados e salva em variáveis
                $metabrasa_credito = get_post_meta($post->ID,'metabrasa_credito',TRUE);
				?>
		
				<?php if (empty($metabrasa_credito)) {
                } else { ?>
                <div class="creditos-portfolio">
				<p><span>Fotografias: </span>&copy; <?php echo $metabrasa_credito; ?></p>
				</div><!-- #creditos-portfolio -->
				<?php }	?>
        
	<div class="esquerda-single-portfolio">

		<header class="entry-header">
			<h1 class="entry-title-interno"><?php the_title(); ?></h1>
			
			    <?php
				// Pega os dados e salva em variáveis
                $metabrasa_subtitulo = get_post_meta($post->ID,'metabrasa_subtitulo',TRUE);
				?>
				<?php if (empty($metabrasa_subtitulo)) {
                } else { ?>
				<h3 class="entry-sub-title-interno"><?php echo $metabrasa_subtitulo; ?></h3>
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
			<?php get_sidebar( 'portfolio' ); ?>
			</div><!-- #direita-single-portfolio -->
			
		</div><!-- #content -->
		
			            <div class="clearfix">
						</div>

<?php get_footer( 'portfolio' ); ?>

	</div><!-- #primary -->
	

