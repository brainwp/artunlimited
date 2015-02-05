<?php get_header( 'portfolio' ); ?>

		<div id="content-interno" class="site-content" role="main">
		
		<div class="archive-portfolio">
			
			<div class="header-portfolio">
                       		<div id="busca-aba" class="portfolio">
                        		<div id="lupa-aba"></div>
                       		<form id="searchform" action="<?php bloginfo('url'); ?>/" method="get">
					<input class="inlineSearch" type="text" name="s" value="busca" onblur="if (this.value == '') {this.value = 'busca';}" onfocus="if (this.value == 'busca') {this.value = '';}" />
					<input type="hidden" name="post_type" value="portfolio" />
					<!-- <input class="inlineSubmit" id="searchsubmit" type="submit" alt="Search" value="Buscar" /> -->
                            </form>
                        </div><!-- #busca-aba -->
                    </div><!-- .header-portfolio -->
			
	<?php
		/* $paged é a variável para paginação do Loop CPT Projetos */	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		/* $args_loop_cpt_projetos são os argumentos para o Loop */
		$args_loop_cpt_projetos = array(
		'post_type' => 'portfolio',
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => '66',
		'paged' => $paged
		);
		$loop_cpt_projetos = new WP_Query( $args_loop_cpt_projetos ); if ( $loop_cpt_projetos->have_posts() ) {
		while ( $loop_cpt_projetos->have_posts() ) : $loop_cpt_projetos->the_post();
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

			<?php
				// Fim do Loop
				endwhile;
			}
			?>

		</div> <!-- .archive-portfolio -->

		</div><!-- #content -->
  
<?php get_footer( 'portfolio' ); ?>
