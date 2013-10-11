<?php get_header('portfolio'); ?>

	<div id="primary" class="content-area">
		<div id="content-interno" class="site-content" role="main">
		
		<div class="archive-portfolio">
			
			        <div class="header-categories">
                            <ul class="separated-list menu">
                                <?php
                                  $myterms = get_terms( 'tipo' );
                                  foreach($myterms as $term){
                                    $root_url = get_bloginfo('url');
                                    $term_taxonomy = $term->taxonomy;
                                    $term_slug = $term->slug;
                                    $term_name = $term->name;
                                    $link = $root_url.'/'.$term_taxonomy.'/'.$term_slug;
                                    $output .= "<option value='".$link."'>".$term_name."</option>";
                                  echo "<li><a href=";
                                  echo $link . ">" . $term_name;
                                  echo "</a></li>";
                                  }
                                ?>
                            </ul>
                            <div id="busca-aba">
                            <div id="lupa-aba"></div>
                            <form id="searchform" action="<?php bloginfo('url'); ?>/" method="get">
                            <input class="inlineSearch" type="text" name="s" value="Pesquisar" onblur="if (this.value == '') {this.value = 'Pesquisar';}" onfocus="if (this.value == 'Pesquisar') {this.value = '';}" />
                            <input type="hidden" name="post_type" value="portfolio" />
                            <!-- <input class="inlineSubmit" id="searchsubmit" type="submit" alt="Search" value="Buscar" /> -->
                            </form>
                            </div><!-- #busca-aba -->
                    </div><!-- .header-categories -->
			
						<?php
							/* $paged é a variável para paginação do Loop CPT Projetos */	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

							/* $args_loop_cpt_projetos são os argumentos para o Loop */
							$args_loop_cpt_projetos = array(
							'post_type' => 'portfolio',
							'orderby' => 'date',
							'order' => 'DESC',
							'posts_per_page' => '12',
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
								<h3><a class="titulo-resumo" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
	</div><!-- #primary -->

<?php get_footer(); ?>