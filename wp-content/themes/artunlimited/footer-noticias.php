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
			<?php $contatos = get_page_by_title( 'Contatos' ); ?>
			<?php echo get_post_meta($contatos->ID,'meta_endereco',true); ?>,
            <?php echo get_post_meta($contatos->ID,'meta_bairro',true); ?> - 
            <?php echo get_post_meta($contatos->ID,'meta_cidade_uf_pais',true); ?>&nbsp;&nbsp;&nbsp;Tel. <?php echo get_post_meta($contatos->ID,'meta_telefone_a',true); ?>&nbsp;&nbsp;&nbsp; 
            <?php echo get_post_meta($contatos->ID,'meta_telefone_b',true); ?>
		</div><!-- .infos-rodape  -->
            
    </div><!-- .footer -->
    
	</div><!-- #main -->
	</div><!-- #page -->
    
</body>
</html>
