<?php /** * Template Name: Inicial (Home) */

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

	<div class="center">
    
		<div class="header-sub-content">
			<div class="seta-header"></div>
			<div class="titulo-header"><h2><?php echo $quem_somos->post_title; ?></h2></div>
		</div>
        <?php $content_quem_somos = apply_filters('the_content', $quem_somos->post_content); ?>
        <div class="content-quem-somos">
            <?php echo $content_quem_somos; ?>
        </div><!-- .content-quem-somos -->
    </div><!-- .center -->
<div class="footer-sub-content">
</div>
    </div><!-- .sub-content -->
<!-- Final Quem Somos -->

<!-- Prêmios -->
    <div class="sub-content" id="nav-premios">
        <?php
        $premios = get_page_by_title( 'Premios' );
        $thumbnail_premios = wp_get_attachment_image_src( get_post_thumbnail_id($premios->ID), '', false, '' );
        $content_premios = apply_filters('the_content', $premios->post_content);
        ?>
        <div style="background: url('<?php echo $thumbnail_premios[0]; ?>')" class="thumb-sub-content-esquerda">
        </div><!-- .thumb-sub-content-esquerda -->

<div class="falsa">
</div>
        

<div class="header-sub-content">
	<div class="seta-header"></div>
    <div class="titulo-header"><h2><?php echo $premios->post_title; ?></h2></div>
</div>
            <div class="scroll-pane">
                  
				<div class="content-premios">
                <?php echo $content_premios; ?>
                </div><!-- .content-premios -->
            </div><!-- .scroll-pane -->
            
<div class="footer-sub-content">
</div>

    </div><!-- .sub-content -->
      
<!-- slider container -->
<!-- Final Prêmios -->
    
<!-- Clientes e Parceiros -->

	<?php
	$clientes = get_page_by_title( 'Clientes e Parceiros' );
	$thumbnail_clientes = wp_get_attachment_image_src( get_post_thumbnail_id($clientes->ID), '', false, '' );
	$content_clientes = apply_filters( 'the_content', $clientes->post_content );
	$content_clientes = preg_replace(array('{<a[^>]*><img}','{/></a>}'), array('<img','/>'), $content_clientes);
	?>

	<div class="sub-content" id="nav-clientes-parceiros">
   
	<div style="background: url('<?php echo $thumbnail_clientes[0]; ?>')" class="thumb-sub-content-direita">
	</div><!-- .thumb-sub-content-direita -->

<div class="header-sub-content">
	<div class="seta-header"></div>
    <div class="titulo-header"><h2><?php echo $clientes->post_title; ?></h2></div>
</div>

	<div class="scroll-panes">            	                   
			<div class="content-clientes">
 
			<?php echo $content_clientes; ?>

			</div><!-- .content-clientes -->
	</div><!-- .scroll-pane -->

<div class="footer-sub-content">
</div>

	</div><!-- .sub-content -->
<!-- Final Clientes e Parceiros -->
    
    
<!-- Notícias -->

	<div class="sub-content" id="nav-noticias">
	
	        <?php
            $noticias = get_page_by_title( 'Noticias' );
			$thumbnail_noticias = wp_get_attachment_image_src( get_post_thumbnail_id($noticias->ID), '', false, '' );		
            ?>
	
	<div style="background: url('<?php echo $thumbnail_noticias[0]; ?>')" class="thumb-sub-content-noticias">
	</div><!-- .thumb-sub-content-direita -->
			
		<div class="header-sub-content">
	<div class="seta-header"></div>
    <div class="titulo-header"> <h2><?php echo $noticias->post_title; ?></h2><span><a href="<?php bloginfo( 'home' ); ?>/noticias">Ver todas</a></span></div>
		</div>

					<div class="todas-noticias">
					<?php $custom_query = new WP_Query('posts_per_page=4');
                    while($custom_query->have_posts()) : $custom_query->the_post(); ?>
                    
                    <div class="cada-noticia">
						<div class="data-cada-noticia">
                        <?php
						$mes = get_the_date( 'M' );
						$dia = get_the_date( 'd' );
						?>
						<p class="p-mes"><?php echo $mes; ?></p>
                        <p class="p-dia"><?php echo $dia; ?></p>
            			</div><!-- .data-cada-noticia -->
                        
                        <div class="thumb-cada-noticia">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumb-noticias' ); ?></a>
            			</div><!-- .thumb-cada-noticia -->
                        
                        <div class="content-cada-noticia">
                        <a class="titulo-cada-noticia" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
                        <?php limit_words(get_the_excerpt(), '20'); ?>...
			            </div><!-- .content-cada-noticia -->
                        
                        <div class="footer-cada-noticia">
                        <div class="categorias-cada-noticia"><?php the_category(' | '); ?></div>
						<div class="mais-cada-noticia"><a href="<?php the_permalink(); ?>">+</a></div>
			            </div><!-- .footer-cada-noticia -->
                    </div><!-- .cada-noticia -->
					<?php endwhile; ?>
                    <?php wp_reset_postdata(); // reset the query ?>  
					</div><!-- .todas-noticia -->
    </div><!-- .sub-content -->
<!-- Final Notícias -->

   	<!-- Contatos -->
	

        <div class="sub-content" id="nav-contatos">
            <?php
            $contatos = get_page_by_title( 'Contatos' );
			/*$thumbnail_contatos = wp_get_attachment_image_src( get_post_thumbnail_id($contatos->ID), '', false, '' );*/
			$content_contatos = apply_filters('the_content', $contatos->post_content);

			$endereco = get_post_meta($contatos->ID,'meta_endereco',true);
			$bairro = get_post_meta($contatos->ID,'meta_bairro',true);
            ?>

   			<div style="background: url('<?php echo $thumbnail_contatos[0]; ?>')" class="thumb-sub-content-direita">
            	<?php echo do_shortcode('[google-map-sc id="22" width="280" height="730" margin="0" zoom="15"]'); ?>
            </div><!-- .thumb-sub-content-direita -->
			
				<div class="header-sub-content">
					<div class="seta-header">
					</div>
					<div class="titulo-header"><h2>Onde nos Encontrar:</h2>
					</div>
				</div>
             
        <div class="content-contatos">
				
  			<div class="esquerda-contatos">
            <?php echo get_post_meta($contatos->ID,'meta_endereco',true); ?><br />
            <?php echo get_post_meta($contatos->ID,'meta_bairro',true); ?><br />
            <?php echo get_post_meta($contatos->ID,'meta_cep',true); ?><br />
            <?php echo get_post_meta($contatos->ID,'meta_cidade_uf_pais',true); ?><br />
            </div><!-- .esquerda-contatos -->
				
  			<div class="direita-contatos">
            Tel. <?php echo get_post_meta($contatos->ID,'meta_telefone_a',true); ?><br />
            <?php echo get_post_meta($contatos->ID,'meta_telefone_b',true); ?><br />
            </div><!-- .direita-contatos -->
            
			<div class="clear"></div>
			
			<?php echo $content_contatos; ?>
			
        </div><!-- .content-contatos -->

        </div><!-- .sub-content -->
		<!-- Final Contatos -->

<?php get_footer(); ?>
