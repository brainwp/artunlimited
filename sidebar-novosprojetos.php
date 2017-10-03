<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package artunlimited
 */
?>
	<div id="linguas">
		    <h2 class="fonte-roxa"><?php echo __('[:en]Choose language[:pb]Escolha o Idioma[:]'); ?></h2>
		    <?php 	
		    	if (function_exists('dynamic_sidebar')) {
					dynamic_sidebar('Widget no menu');
				} 
			?>
			<br>
	    <a class="a-etiqueta" href="<?php echo home_url('/projetos'); ?>"><h3>Voltar</h3></a>

	</div><!-- #linguas -->


		

