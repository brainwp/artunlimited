<?php 
if (!is_user_logged_in()) {
	header( 'Location: '.get_home_url('index.php/projetos/') ) ; 
	die();
}
	global $current_user, $wpdb;
	$role = $wpdb->prefix . 'capabilities';
	$current_user->role = array_keys($current_user->$role);

	$role = $current_user->role[0];
	
if ( $role != 'parceiro' AND $role!= "administrator") {
	header( 'Location: '.get_home_url('index.php/projetos/') ) ; 
	die();

	} 
?>
<?php get_header( 'novosprojetos' ); ?>

		<div id="content-interno" class="site-content" role="main">
		
		<div class="archive-portfolio">

			        <div class="header-portfolio">
                      
       <div class="area-4-header">
        <div id="link-login">
   		    <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Sair">
				<div id="cadeado">
				</div>
				<span class="link-tgl">						
					<?php echo __('[:en]Logout[:pb]Sair[:]');?>
				</span>
			</a>
        </div>
    </div><!-- .area-4-header -->
		
	<div class="area-3-header">

        <div id="linguas">
        	
            <?php 	
            	if (function_exists('dynamic_sidebar')) {
					dynamic_sidebar('Widget no menu');
				} 
			?>
         
        </div><!-- #linguas -->
    </div><!-- .area-3-header -->
                    </div><!-- .header-portfolio -->
			
						<?php
							/* $paged é a variável para paginação do Loop CPT Projetos */	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

							/* $args_loop_cpt_projetos são os argumentos para o Loop */
							$args_loop_cpt_projetos = array(
							'post_type' => 'novosprojetos',
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
