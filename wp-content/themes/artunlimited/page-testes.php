<?php

/**

 * Template Name: Testes

 */



get_header(); ?>

	<div id="content-pages">
		<div id="content" class="page-content" role="main">

 <form name="form1" method="POST" action="">
				<input name="cor" type="text" value=""><br />
                <input type="submit" value="Enviar Formul�rio" />
</form>

<?php

if(isset($_POST['cor'])){
	$img = $_POST['cor'];
	echo $img;
}





	foreach(get_the_category() as $category) {

	$link = '<a href="'.get_category_link($category->cat_ID).'">Ver Todos</a>';

	}



	$quantos_meses = 2;

	$contando = count_posts( $category->slug );		

	if ( $contando > $quantos_meses ) {

		echo $link;

	}

?>



<hr>

<?php

$args = array(

	'posts_per_page' => -1,

    'ignore_sticky_posts' => 1

);



	$posts_tres_meses = new WP_Query($args);

	while($posts_tres_meses->have_posts()) { $posts_tres_meses->the_post();

	

	// M�s do post

	$mes = get_the_date('n');	

	// Mostrar quantos meses

	$quantos_meses = 3;

	// M�s do post - Quantos meses

	$mes_menos_tres = $mes - $quantos_meses;



	if ( $mes > $quantos_meses && $mes_menos_tres <  $mes ) { ?>	

		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	<?php

	// Fecha o IF

	} ?>

<?php

// Fecha o Loop

} ?>



<?php 
// Save before $_POST is re-set by categories.php

	function my_sideload_image() {
    	$file = media_sideload_image( 'http://2013.russia.wordcamp.org/files/2013/06/wordcamp-150x150.png', 5 );
	}
add_action( 'wp_head', 'my_sideload_image' );

//add_action ('all', create_function ('', 'var_dump (current_filter ());'));

?>

		</div><!-- #content -->

	</div><!-- #content-pages -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>

