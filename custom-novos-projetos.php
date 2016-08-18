<?php
/**
* Adicionamos uma acção no inicio do carregamento do WordPress
* através da função add_action( 'init' )
*/

add_action( 'init', 'create_post_type_novosprojetos' );

/** * Esta é a função que é chamada pelo add_action() */
function create_post_type_novosprojetos() {
	/**     * Labels customizados para o tipo de post     */
	$labels = array(
		'name' => _x('Novos Projetos', 'post type general name'),
		'singular_name' => _x('Projeto', 'post type singular name'),
		'add_new' => _x('Novo Projeto', 'projeto'),
	    'add_new_item' => __('Novo Projeto'),
	    'edit_item' => __('Editar Projeto'),
	    'new_item' => __('Novo Projeto'),
	    'all_items' => __('Ver Todos'),
	    'view_item' => __('Ver Projeto'),
	    'search_items' => __('Procurar Projetos'),
	    'not_found' =>  __('Nenhum projeto encontrado'),
	    'not_found_in_trash' => __('Nenhum projeto encontrado no lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Novos Projetos'
    );

/**     * Registamos o tipo de post portfolios através desta função     
		* passando-lhe os labels e parâmetros de controlo.
 */
    register_post_type( 'novosprojetos', array(
		'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'show_in_menu' => true,
	    'has_archive' => 'projetos',
	    'query_var' => true,
		'rewrite' => array(
			'slug' => 'projetos',
			'with_front' => false,
	    ),
	    'capability_type' => 'post',
	    'has_archive' => true,
	    'hierarchical' => true,
	    'menu_position' => null,
	    'supports' => array('title','editor','thumbnail')
		)    );

	flush_rewrite_rules();}


register_taxonomy(
	"tipo", 
		  "novosprojetos", 
		  array(            
			"label" => "Tipo", 
				"singular_label" => "Tipo", 
				"rewrite" => true,
				"hierarchical" => true
	)
);
?>