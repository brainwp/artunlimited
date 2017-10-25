<?php
/**
 * The Template for displaying all single posts.
 * @package artunlimited
 */

get_header( 'portfolio' ); ?>

<div class="content-single-portfolio">
	<div id="content-interno" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
		<?php global $post; ?>

		<div id="slider-portfolio">

			<div id="carousel_wrap">
				<a class="prev" id="prev2" href="#"><span>anterior</span></a>
				<a class="next" id="next2" href="#"><span>seguinte</span></a>
				<ul id="carousel">

					<?php
					$anexos = get_post_meta( $post->ID, 'portfolio_slider', true );
					$anexos = explode( ',', $anexos );

					if ( $anexos && is_array( $anexos) && ! empty( $anexos ) ) {
						foreach ( $anexos as $attachment_id ) { ?>
						<?php
						$anexo = get_post( $attachment_id );
						if ( ! $anexo ) {
							continue;
						}
						$image_attributes = wp_get_attachment_image_src( $attachment_id, 'projetos' );
						$attachment_page = get_attachment_link( $attachment_id );
						$description = $anexo->post_content;
						$url = wp_get_attachment_url( $attachment_id );
						?>
						<li class="cada-slide">
							<?php
							?>
							<img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo apply_filters('the_title', $anexo->post_title); ?>">
						</li>
						<?php } } ?>
					</ul>

					<div class="clearfix">
					</div>

				</div><!-- carousel_wrap -->
			</div><!-- #sider-projetos -->

		<?php
				// Pega os dados e salva em variáveis
		$metaportfolio_credito = get_post_meta($post->ID,'metaportfolio_credito',TRUE);
		?>

		<?php if (empty($metaportfolio_credito)) {
		} else { ?>
		<div class="creditos-portfolio">
			<p><span><?php echo __('[:en]Photos[:pb]Fotografias:[:]'); ?> </span>&copy; <?php echo $metaportfolio_credito; ?></p>
		</div><!-- #creditos-portfolio -->
		<?php }	?>

		<div class="esquerda-title-single-portfolio" id="the-content">

			<header class="entry-header">
				<h1 class="entry-title-interno"><?php the_title(); ?></h1>

				<?php
				// Pega os dados e salva em variáveis
				$metaportfolio_2alinhatitulo = get_post_meta($post->ID,'metaportfolio_2alinhatitulo',TRUE);
				?>

				<?php if (empty($metaportfolio_2alinhatitulo)) {
				} else { ?>
				<h1 class="entry-title-interno"><?php echo $metaportfolio_2alinhatitulo; ?></h1>
				<?php }	?>

				<?php
				// Pega os dados e salva em variáveis
				$metaportfolio_subtitulo = get_post_meta($post->ID,'metaportfolio_subtitulo',TRUE);
				?>
				<?php if (empty($metaportfolio_subtitulo)) {
				} else { ?>
				<h3 class="entry-sub-title-interno"><?php echo $metaportfolio_subtitulo; ?></h3>
				<?php }	?>
			</header><!-- .entry-header -->

		</div><!-- .esquerda-title-single-portfolio -->

		<div class="clear"></div>

		<div class="esquerda-single-portfolio">

			<div class="entry-content">
				<?php the_content(); ?>
				<?php $videos = get_post_meta( get_the_ID(), '_portfolio_videos', false );?>
				<?php if ( $videos && isset( $videos[0] ) && ! empty( $videos[0] ) ) : ?>
					<h2 class="fonte-roxa">
						<?php _e('[:en]Videos:[:pb]Audiovisual:[:]'); ?>
					</h2><!-- .fonte-roxa -->
					<?php foreach( $videos[0] as $video_url ) : ?>
						<?php echo wp_oembed_get( $video_url );?>
					<?php endforeach;?>
				<?php endif;?>

				<?php $graphic = get_post_meta( get_the_ID(), 'portfolio_graphic', true );?>
				<?php if ( $graphic && ! empty( explode( ',', $graphic ) ) ) :?>
					<h2 class="fonte-roxa" data-text="<?php _e( '[:en]Graphic Design:[:pb] Design Gráfico:[:]' );?>">
						<?php _e( '[:en]Graphic Design:[:pb]Material Gráfico:[:]' ); ?>
					</h2><!-- .fonte-roxa -->
					<?php $content_value = get_post_meta( get_the_ID(), 'portfolio_graphic_content', true ); ?>
					<?php if ( ! $content_value || ! is_string( $content_value) ) {
						$content_value = '';
					}?>
					<?php echo apply_filters( 'the_content', $content_value );?>
					<?php $value = '[gallery ids="%s" type="square"]';?>
					<?php $value = sprintf( $value, $graphic );?>
					<?php echo apply_filters( 'the_content', $value );?>
				<?php endif;?>

				<?php $clipping = get_post_meta( get_the_ID(), 'portfolio_clipping', true );?>
				<?php if ( $clipping && ! empty( explode( ',', $clipping ) ) ) :?>
					<h2 class="fonte-roxa">
						<?php _e( '[:en]Media:[:pb]Clipping:[:]' ); ?>
					</h2><!-- .fonte-roxa -->
					<?php $value = '<div id="graphic-design">[gallery type="thumbnails" ids="%s"]</div>';?>
					<?php $value = sprintf( $value, $clipping );?>
					<?php echo apply_filters( 'the_content', $value );?>
				<?php endif;?>

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

</div><!-- #content-single-portfolio -->


