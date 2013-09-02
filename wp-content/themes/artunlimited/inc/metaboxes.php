<?php

    $prefix = 'meta_';
    $meta_box = array(
		'id' => 'my-meta-box',
		'title' => 'Informa&ccedil;&otilde;es de Contato',
		'page' => 'page',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
			'name' => 'Endere&ccedil;o',
			'desc' => 'Adicione o endere&ccedil;o',
			'id' => $prefix . 'endereco',
			'type' => 'text',
			'std' => ''
			),
			array(
			'name' => 'Bairro',
			'desc' => 'Adicione o bairro',
			'id' => $prefix . 'bairro',
			'type' => 'text',
			'std' => ''
			),
			array(
			'name' => 'CEP',
			'desc' => 'Adicione o CEP',
			'id' => $prefix . 'cep',
			'type' => 'text',
			'std' => ''
			),
			array(
			'name' => 'Cidade | UF | Pa&iacute;s',
			'desc' => 'Adicione a cidade, UF e pa&iacute;s',
			'id' => $prefix . 'cidade_uf_pais',
			'type' => 'text',
			'std' => ''
			),
			array(
			'name' => 'Telefone',
			'desc' => 'Adicione o telefone',
			'id' => $prefix . 'telefone_a',
			'type' => 'text',
			'std' => ''
			),
			array(
			'name' => 'Telefone',
			'desc' => 'Adicione um segundo telefone, se houver',
			'id' => $prefix . 'telefone_b',
			'type' => 'text',
			'std' => ''
			),
		)
    );
	
add_action('admin_menu', 'mytheme_add_box');
   
// Adiciona o MetaBox
function mytheme_add_box() {
    global $meta_box;
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;    
	$o_id = id_por_slug( 'Contatos' );
	if ($post_id == $o_id)
	{
	add_meta_box(
		$meta_box['id'],
		$meta_box['title'], 
		'mytheme_show_box',
		$meta_box['page'],
		$meta_box['context'],
		$meta_box['priority']);
}
}
	
// Callback function to show fields in meta box
function mytheme_show_box() {
    global $meta_box, $post;
    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	// Inicia a tabela
	echo '<table class="agenda-table">';
    foreach ($meta_box['fields'] as $field) {
    // get current post meta data
    $meta = get_post_meta($post->ID, $field['id'], true);
    
	// Inicia o tr
	echo '<tr>',
    '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th></tr>',
    '<td>';
    switch ($field['type']) {
    case 'text':
    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', '<span class="agenda-table-desc">', $field['desc'], '</span>';
    break;
    case 'textarea':
    echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
    break;
    case 'select':
    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
    foreach ($field['options'] as $option) {
    echo '<option ', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
    }
    echo '</select>';
    break;
    case 'radio':
    foreach ($field['options'] as $option) {
    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
    }
    break;
    case 'checkbox':
    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
    break;
    }
    echo '</td>',
    '</tr>';
    }
    // Fecha a tabela
	echo '</table>';
    }
	
	add_action('save_post', 'mytheme_save_data');
    
	// Save data from meta box
    function mytheme_save_data($post_id) {
    global $meta_box;
	
    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
    }
    // Checa se AutoSave está ativo e o ignora
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
    }
    // Checa as Permissões do Usuário
    if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
    return $post_id;
    }
    } elseif (!current_user_can('edit_post', $post_id)) {
    return $post_id;
    }
    
	foreach ($meta_box['fields'] as $field) {
    $old = get_post_meta($post_id, $field['id'], true);
    $new = $_POST[$field['id']];
    if ($new && $new != $old) {
    update_post_meta($post_id, $field['id'], $new);
    } elseif ('' == $new && $old) {
    delete_post_meta($post_id, $field['id'], $old);
    }
    }
    }
 /**
 * Adiciona o CSS para o jQuery DatePicker da Agenda e demais estilos
 */
function metaboxes_css() {
	wp_enqueue_style(
		'estilo-metaboxes',
		get_bloginfo('stylesheet_directory') . '/inc/estilo-metaboxes.css'
	);
}
add_action('admin_print_styles-post.php', 'metaboxes_css');

?>