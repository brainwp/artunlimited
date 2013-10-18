<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the id=main div and all content after
 * @package artunlimited
 */
?>

<?php if (is_single()) {
	$classe = "footer";
} else {
	$classe = "footer footer-single";
} ?>

    <div class="<?php echo $classe; ?>">
		<?php wp_footer(); ?>
		<div class="infos-rodape">
			<?php $contatos = get_page_by_title( 'Contatos' ); ?>
			<?php echo get_post_meta($contatos->ID,'meta_endereco',true); ?>,
            <?php echo get_post_meta($contatos->ID,'meta_bairro',true); ?> - 
            <?php echo get_post_meta($contatos->ID,'meta_cidade_uf_pais',true); ?><br />
            Tel. <?php echo get_post_meta($contatos->ID,'meta_telefone_a',true); ?>&nbsp;&nbsp;&nbsp; 
            <?php echo get_post_meta($contatos->ID,'meta_telefone_b',true); ?>
		</div><!-- .infos-rodape  -->
            
		<div id="redes">
        	<div id="facebook">
            	<a class="a-redes" href="<?php echo get_option( 'mo_facebook' ); ?>"></a>
            </div><!-- #facebook -->
            
            <div id="linkedin">
            	<a class="a-redes" href="<?php echo get_option( 'mo_linkedin' ); ?>"></a>
		    </div><!-- #linkedin -->
        </div><!-- #redes -->
    </div><!-- .footer -->
    
	</div><!-- #main -->
	</div><!-- #page -->
    
</body>
</html>