<?php 
/** Template Name: Inicial (Home) 
*/
get_header( 'home' ); ?>
 
<div id="slider">

	<?php echo do_shortcode( '[orbit-slider]' );?>

</div><!-- #slider -->
	
<!-- Quem Somos -->
    <div class="sub-content" id="nav-quem-somos">
    
    <div id="thumbs-quem-somos">
    <?php
    $quem_somos = "";
    $quem_somos = get_page_by_title( 'Art Unlimited' );
    $attachment_page = get_attachment_link($quem_somos->ID); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();    
    	$args = array(
        	'post_type' => 'attachment',
            'numberposts' => 15,
            'post_status' => null,
            'post_parent' => $quem_somos->ID,
            'orderby' => 'rand'
		);

		$attachments = get_posts( $args );
		if ( $attachments ) {
			foreach ( $attachments as $attachment ) {
			$image_attributes = wp_get_attachment_image_src( $attachment->ID ); // returns an array
			echo '<div class="imagens-post">';
			echo '<img src="'.$image_attributes[0].'">';
			echo '</div>';
	  		}
		}
    	endwhile; endif; ?>
        </div><!-- #thumbs-quem-somos -->

	    <?php wp_reset_postdata(); // reset the query ?>   

	<div class="center-content">
        <?php $content_quem_somos = apply_filters('the_content', $quem_somos->post_content); ?>
        <div class="content-quem-somos">
            <?php echo $content_quem_somos; ?>
        </div><!-- .content-quem-somos -->
    </div><!-- .center-content -->
    </div><!-- .sub-content -->
<!-- Final Quem Somos -->

<!-- Prêmios -->
    <div class="sub-content" id="nav-premios">

    	<div class="center-content">
	        <?php
		        $premios = get_page_by_title( 'Premios' );
	    	    $content_premios = apply_filters('the_content', $premios->post_content);
	        ?>

			<div class="header-sub-content">
				<div class="titulo-header"><h2><?php echo $premios->post_title; ?></h2></div>
			</div>
							  
			<div class="content-premios">
	        	<?php echo $content_premios; ?>
	        </div><!-- .content-premios -->
    	</div><!-- .center-content -->
            
    </div><!-- .sub-content -->
      
<!-- slider container -->
<!-- Final Prêmios -->
    
<!-- Clientes e Parceiros -->

	<div class="sub-content" id="nav-clientes-parceiros">

		<div class="center-content">
		<?php
			$clientes = "";
			$clientes = get_page_by_title( 'Clientes e Parceiros' );
			$attachment_clientes = get_attachment_link($clientes->ID);
			$content_clientes = apply_filters('the_content', $clientes->post_content);
		?>  

			<div class="header-sub-content">
		    	<div class="titulo-header"><h2><?php echo $clientes->post_title; ?></h2></div>
			</div>

			<div class="content-intro-clientes">
	  			<?php echo $content_clientes; ?>
	  		</div><!-- .content-intro-clientes -->
		        	                   
			<div class="content-clientes">
				<!-- <div class="scroll-panes">  -->   
					<?php   
				    	$args_clientes = array(
							'post_type' => 'attachment',
							'numberposts' => -1,
							'post_status' => null,
							'post_parent' => $clientes->ID,
							'orderby' => 'menu_order',
							'order' => 'ASC'
						);

						$attachments_clientes = get_posts( $args_clientes );
						if ( $attachments_clientes ) {
							foreach ( $attachments_clientes as $attachment_cliente ) {
							$image_attributes_cliente = wp_get_attachment_image_src( $attachment_cliente->ID );
							echo '<div class="imagens-cliente">';
							echo '<img src="'.$image_attributes_cliente[0].'">';
							echo '</div>';
					  		}
						} ?>

					    <?php wp_reset_postdata(); ?>   
				<!-- </div> .scroll-pane -->
			</div><!-- .content-clientes -->
			
		<div class="footer-sub-content"></div>

		</div><!-- .center-content -->

	</div><!-- .sub-content -->
<!-- Final Clientes e Parceiros -->
    
    
<!-- Notícias -->
	<div class="sub-content" id="nav-noticias">
	
		<div class="center-content">

		<?php $noticias = get_page_by_title( 'Noticias' ); ?>
	
			<div class="header-sub-content">
			    <div class="titulo-header-noticias">
			    	<h2><?php echo $noticias->post_title; ?></h2><span><a href="<?php echo home_url('index.php/noticias'); ?>">Ver todas</a></span>
			    </div>
			</div><!-- .header-sub-content -->

			<div class="todas-noticias">
			<?php $custom_query = new WP_Query('posts_per_page=3');
			$count_n = 0;
            while($custom_query->have_posts()) : $custom_query->the_post(); ?>
            
            <div class="cada-noticia">
				<a href="<?php the_permalink(); ?>">						
					<div class="data-cada-noticia">
                        <?php
							$mes = get_the_date( 'M' );
							$dia = get_the_date( 'd' );
						?>
						<p class="p-mes"><?php echo $mes; ?></p>
                        <p class="p-dia"><?php echo $dia; ?></p>
        			</div><!-- .data-cada-noticia -->
				</a>
                
                <div class="thumb-cada-noticia">
                	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumb-projetos' ); ?></a>
    			</div><!-- .thumb-cada-noticia -->
                
				<a class="titulo-cada-noticia" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				
				<div class="clear"></div>                        
				
				<div class="content-cada-noticia">
					<?php limit_words(get_the_excerpt(), '20'); ?>...
	            </div><!-- .content-cada-noticia -->
                
                <div class="footer-cada-noticia">
                	<div class="categorias-cada-noticia"><?php the_category(' | '); ?></div>
					<div class="mais-cada-noticia"><a href="<?php the_permalink(); ?>">+</a></div>
	            </div><!-- .footer-cada-noticia -->
            </div><!-- .cada-noticia -->
            <?php
            	$count_n++;
            	if ($count_n == 3) : ?>
            		<div class="clear_noticia"></div>
			<?php
				$count_n = 0;
				endif;
            ?>
			<?php endwhile; ?>
            <?php wp_reset_postdata(); ?>  
			</div><!-- .todas-noticia -->

		</div><!-- .center-content -->

    </div><!-- .sub-content -->
<!-- Final Notícias -->

   	<!-- Contatos -->
	
        <div class="sub-content" id="nav-contatos">

   			<div class="thumb-sub-content-direita" id="contato-mapa">
            	<?php echo do_shortcode('[google-map-sc id="22" width="280" height="960" margin="0" zoom="15"]'); ?>
            </div><!-- .thumb-sub-content-direita -->

        	<div class="center-content">

            <?php
	            $contatos = get_page_by_title( 'Contatos' );
				$content_contatos = apply_filters('the_content', $contatos->post_content);
				$endereco = get_post_meta($contatos->ID,'meta_endereco',true);
				$bairro = get_post_meta($contatos->ID,'meta_bairro',true);
            ?>
	
					<div class="header-sub-content">
						<div class="titulo-header"><h2>Onde nos Encontrar:</h2></div>
					</div><!-- .header-sub-content -->
	             
			        <div class="content-contatos">
							
			  			<!--<div class="esquerda-contatos">
				            <?php // echo get_post_meta($contatos->ID,'meta_endereco',true); ?><br />
				            <?php // echo get_post_meta($contatos->ID,'meta_bairro',true); ?><br />
				            <?php // echo get_post_meta($contatos->ID,'meta_cep',true); ?><br />
				            <?php // echo get_post_meta($contatos->ID,'meta_cidade_uf_pais',true); ?><br />
			            </div> .esquerda-contatos -->
							
			  			<!--<div class="direita-contatos">
			            	Tel. <?php // echo get_post_meta($contatos->ID,'meta_telefone_a',true); ?><br />
			            	<?php // echo get_post_meta($contatos->ID,'meta_telefone_b',true); ?><br />
			            </div> .direita-contatos -->
			            
						<div class="clear"></div>
						
						<?php echo $content_contatos; ?>
									
						<div class="clear"></div>

						<?php get_sidebar('contatohome'); ?>
						
			        </div><!-- .content-contatos -->
			
				<div class="footer-sub-content"></div>
			
			</div><!-- .center-content -->

        </div><!-- .sub-content -->
		<!-- Final Contatos -->

<?php get_footer('noticias'); ?>
