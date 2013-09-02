<?php get_header( 'interno' ); ?>
<?php
	/* $paged é a variável para paginação do Loop CPT Projetos */	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	/* $args_loop_cpt_projetos são os argumentos para o Loop */
	$args_loop_cpt_projetos = array(		'post_type' => 'portfolio',		'orderby' => 'date',		'order' => 'DESC',		'posts_per_page' => '12',		'paged' => $paged
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

<?php get_footer(); ?>