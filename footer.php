<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the id=main div and all content after
 * @package artunlimited
 */
?>

    <div class="footer-noticias">
		<?php wp_footer(); ?>
		<div class="infos-rodape">
			<?php $contatos = get_page_by_slug('contatos'); ?>
			<?php echo get_post_meta($contatos->ID,'meta_endereco',true); ?>,
            <?php echo get_post_meta($contatos->ID,'meta_bairro',true); ?> - 
            <?php echo get_post_meta($contatos->ID,'meta_cidade_uf_pais',true); ?>
            <br />Tel. <?php echo get_post_meta($contatos->ID,'meta_telefone_a',true); ?>&nbsp;&nbsp;&nbsp; 
            <?php echo get_post_meta($contatos->ID,'meta_telefone_b',true); ?>
		</div><!-- .infos-rodape  -->

		<div id="redes">
         	<div id="facebook">
             	<a class="a-redes" href="<?php echo get_option( 'mo_facebook' ); ?>" target="_blank"></a>
             </div><!-- #facebook -->
             
             <div id="linkedin">
             	<a class="a-redes" href="<?php echo get_option( 'mo_linkedin' ); ?>" target="_blank"></a>
 		    </div><!-- #linkedin -->
         </div><!-- #redes -->
            
    </div><!-- .footer -->
    
	</div><!-- #main -->
	</div><!-- #page -->
    
</body>
</html>
