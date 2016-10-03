<?php

/*
Classe metabox-novosprojetos para criação de MetaBox's
Versão 0.1
*/

$prefix = 'metanovosprojetos_';

$meta_box_novosprojetos = array(
	'id' => 'metabox-novosprojetos',
	// Título do MetaBox
	'title' => 'Informa&ccedil;&otilde;es do Projeto',
	// Tipo de Post a usar os MetaBox's
	'page' => 'novosprojetos',
	'context' => 'normal',
	'priority' => 'high',
		// Campos
	'fields' => array(
		array(
		'name' => '2&ordf; Linha do T&iacute;tulo do Projeto',
		'desc' => 'Adicione a 2&ordf; linha do T&iacute;tulo do Projeto',
		'id' => $prefix . '2alinhatitulo',
		'type' => 'text',
		'std' => ''
		),
		array(
		'name' => 'Sub T&iacute;tulo do Projeto',
		'desc' => 'Adicione o Sub T&iacute;tulo do Projeto',
		'id' => $prefix . 'subtitulo',
		'type' => 'text',
		'std' => ''
		),
        array(
        'name' => 'Cr&eacute;dito das Fotografias do Projeto',
        'desc' => 'Adicione o nome do Fot&oacute;grafo do Projeto',
        'id' => $prefix . 'credito',
        'type' => 'text',
        'std' => ''
        ),
	)
);

add_action('admin_menu', 'add_metanovosprojetos');

function add_metanovosprojetos() {
    global $meta_box_novosprojetos;
    add_meta_box(
		$meta_box_novosprojetos['id'],
		$meta_box_novosprojetos['title'], 
		'show_metanovosprojetos',
		$meta_box_novosprojetos['page'],
		$meta_box_novosprojetos['context'],
		$meta_box_novosprojetos['priority']);
}
	
	
// Mostra os MetaBox's (metanovosprojetos)
function show_metanovosprojetos() {
    global $meta_box_novosprojetos, $post;
    // Use nonce for verification
    echo '<input type="hidden" name="metanovosprojetos_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	// Inicia a tabela
	echo '<table class="agenda-table">';
    foreach ($meta_box_novosprojetos['fields'] as $field) {
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
	echo '</table><!-- .metanovosprojetos-table -->';
    }
	
	add_action('save_post', 'save_metanovosprojetos');
    // Save data from meta box
function save_metanovosprojetos($post_id) {
    global $meta_box_novosprojetos;
    // verify nonce
    if (isset($_POST['metanovosprojetos_nonce'])&&!wp_verify_nonce($_POST['metanovosprojetos_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    // Checa se AutoSave está ativo e o ignora
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // Checa as Permissões do Usuário
    if (isset($_POST['post_type'])&&'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } 
    elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
	foreach ($meta_box_novosprojetos['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        if (isset($_POST[$field['id']])) {
           $new = $_POST[$field['id']];
           if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            }
            elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    
    }
}
 /**
 * Adiciona o CSS para o jQuery DatePicker da Agenda e demais estilos
 */
function metabox_novosprojetos_css() {
	wp_enqueue_style(
		'estilo-metaboxes',
		get_bloginfo('stylesheet_directory') . '/inc/estilo-metaboxes.css'
	);
}
add_action('admin_print_styles-post.php', 'metaboxes_css');

?>
