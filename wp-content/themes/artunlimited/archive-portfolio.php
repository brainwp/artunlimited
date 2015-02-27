<?php get_header( 'portfolio' ); ?>

		<div id="content-interno" class="site-content" role="main">

		<div class="archive-portfolio">

			<div class="header-portfolio">

				<div class="header-categories">

					<ul class="separated-list menu"><li class="categoria-li">Areas:</li></ul>

					<ul class="separated-list menu">
					<?php
					  $myterms = get_terms( 'area' );
					    $conta = 0;
					  foreach($myterms as $term){
					    $term_taxonomy = $term->taxonomy;
					    $term_slug = $term->slug;
					    $term_name = $term->name;
					    /*$output .= "<option value='".$link."'>".$term_name."</option>";*/

					 if ($conta < 1){
					    $i = "<li class=\"primeiro-li\"><a class=\"portfolio-ajax\" data-href=";
					} else {
					    $i = "<li><a class=\"portfolio-ajax\" data-href=";
					}
					echo $i;
					  echo $term_slug . ">" . $term_name;
					  echo "</a></li>";
					$conta++;
					  }
					?>
					<li><a class="portfolio-ajax" data-href="false">Exibir todas</a></li>
				    </ul>
				</div><!-- .header-categories -->

                       		<div id="busca-aba" class="portfolio">
                        		<div id="lupa-aba"></div>
                       		<form id="searchform" action="<?php bloginfo('url'); ?>/" method="get">
					<input class="inlineSearch" type="text" name="s" value="busca" onblur="if (this.value == '') {this.value = 'busca';}" onfocus="if (this.value == 'busca') {this.value = '';}" />
					<input type="hidden" name="post_type" value="portfolio" />
					<!-- <input class="inlineSubmit" id="searchsubmit" type="submit" alt="Search" value="Buscar" /> -->
                            </form>
                        </div><!-- #busca-aba -->
            </div><!-- .header-portfolio -->
            <div id="portfolio-ajax-container">
	<?php
		/* $paged é a variável para paginação do Loop CPT Projetos */	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		/* $args_loop_cpt_projetos são os argumentos para o Loop */
		$args_loop_cpt_projetos = array(
		'post_type' => 'portfolio',
		'public' => true,
		'post_parent' => 0,		
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => '66',
		'paged' => $paged
		);
		$loop_cpt_projetos = new WP_Query( $args_loop_cpt_projetos ); if ( $loop_cpt_projetos->have_posts() ) {
		while ( $loop_cpt_projetos->have_posts() ) : $loop_cpt_projetos->the_post(); ?>

			<?php
			get_template_part('content','portfolio');
				// Fim do Loop
				endwhile;
			}
			?>
		</div><!-- #portfolio-container -->
		</div> <!-- .archive-portfolio -->

		</div><!-- #content -->

<?php get_footer( 'portfolio' ); ?>
