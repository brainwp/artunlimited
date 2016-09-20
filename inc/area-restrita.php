<?php 
// cria user 'client'
// cria user 'client'
// cria user 'client'
$result = add_role( 'client', __('Client' ), array(
	'read' => true, // true allows this capability
	'edit_posts' => false, // Allows user to edit their own posts
	'edit_pages' => false, // Allows user to edit pages
	'edit_others_posts' => false, // Allows user to edit others posts not just their own
	'create_posts' => false, // Allows user to create new posts
	'manage_categories' => false, // Allows user to manage post categories
	'publish_posts' => false, // Allows the user to publish, otherwise posts stays in draft mode
	'edit_themes' => false, // false denies this capability. User can’t edit your theme
	'install_plugins' => false, // User cant add new plugins
	'update_plugin' => false, // User can’t update any plugins
	'level_0' => true,
	'update_core' => false // user cant perform core updates
	)

);

//redireciona user 'client' para página projetos
//redireciona user 'client' para página projetos
//redireciona user 'client' para página projetos
function redireciona_login( $redirect_to, $request, $user ) {
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) 
    {
        //check for admins
        if ( in_array( 'client', $user->roles ) ) 
        {

            return get_home_url( ).'/projetos';
        }
    }

    return $redirect_to;
}

add_filter( 'login_redirect', 'redireciona_login', 10, 3 );




// impede user 'client' de usar admin
// impede user 'client' de usar admin
// impede user 'client' de usar admin
function tira_do_admin()
{
    global $current_user;
    wp_get_current_user();
 	if ( in_array( 'client', $current_user->roles ) ) {
         // wp_redirect( home_url() ); exit;

    }
}
add_action('admin_init', 'tira_do_admin');




// remove barra de admin do user 'client'
// remove barra de admin do user 'client'
// remove barra de admin do user 'client'

function remove_barra_admin($content) {
	return ( !current_user_can( 'client' ) ) ? $content : false;
}
add_filter( 'show_admin_bar' , 'remove_barra_admin');