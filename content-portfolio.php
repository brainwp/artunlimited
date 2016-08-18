<?php
global $post;
?>	
		<div class="cada-projeto">

			<div class="thumb-cada-projeto">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumb-projetos'); ?></a>
			</div><!-- .thumb-cada-projeto -->
		
			<div class="rodape-cada-projeto">
				<h3><a class="titulo-resumo" href="<?php the_permalink(); ?>"><?php the_title(); ?><br />
				<?php
				// Pega os dados e salva em variáveis
				$metaportfolio_2alinhatitulo = get_post_meta($post->ID,'metaportfolio_2alinhatitulo',TRUE);
				?>
				<?php if (empty($metaportfolio_2alinhatitulo)) {
				} else { ?>
					  <?php echo $metaportfolio_2alinhatitulo; ?>
				<?php }	?>
				</a></h3>
				<span class="data-cada-post"><?php the_time( 'Y' ); ?></span>
			</div><!-- .rodape-cada-projeto -->
		</div><!-- .cada-projeto -->