<?php
// Theme paths
define('THEME_URI', get_template_directory_uri());
define('THEME_DIR', get_template_directory());

// Assets Version, if some trouble with the cache, update the version
$assets_version = wp_get_theme()['Version'];
define('ASSETS_VERSION', $assets_version);

// Enregistrer les scripts et les styles
function theme_enqueue_scripts() {
    // Enregistrer les scripts
    wp_enqueue_script( 'script', THEME_URI . '/assets/js/script.js', array(), ASSETS_VERSION, true );  
    wp_enqueue_script( 'ajax-script', THEME_URI . '/assets/js/ajax-script.js', array(), ASSETS_VERSION, true ); 

    wp_localize_script('script', 'script_params', [
		'ajaxurl' 					=> admin_url( 'admin-ajax.php' ),
	]); 

    wp_localize_script('ajax-script', 'script_params', [
		'websiteurl' 					=> get_site_url(),
	]); 
    // Enregistrer les styles
    wp_enqueue_style( 'style', THEME_URI."/style.css" , array(), ASSETS_VERSION );
    wp_enqueue_style( 'custom-style', THEME_URI . '/assets/css/custom-style.css', array(), ASSETS_VERSION );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

//Enregistrer les menus wordpress
function register_my_menus() {
    register_nav_menus(
        array(
            'menu-principal' => __( 'Menu Principal' ),
            'menu-secondaire' => __( 'Menu Secondaire' ),
            'mini-menu' => __( 'Mini  menu' ),
            // Ajoutez d'autres emplacements de menu si nécessaire
        )
    );
}
add_action( 'after_setup_theme', 'register_my_menus' );

// Ajoute la prise en charge des modèles de page personnalisés
add_theme_support('custom-page-templates');
add_theme_support('post-thumbnails');

// Désactiver Gutenberg pour un type de publication personnalisé
function disabled_gutenberg_cpt( $use_block_editor, $post_type ) {
    if ( 'photo' === $post_type ) {
        return false;
    }
    return $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'disabled_gutenberg_cpt', 10, 2 );

/******************************************************************************************************************/

// Création d'un custom post type pour les photos
function create_custom_photo_post() {
    $labels = array(
        'name'               => _x( 'photos', 'post type general name', 'textdomain' ),
        'singular_name'      => _x( 'photo', 'post type singular name', 'textdomain' ),
        'menu_name'          => _x( 'Photos ', 'admin menu', 'textdomain' ),
        'name_admin_bar'     => _x( 'Photos ', 'add new on admin bar', 'textdomain' ),
        'add_new'            => _x( 'Ajouter', 'custom post', 'textdomain' ),
        'add_new_item'       => __( 'Ajouter une nouvelle Photo', 'textdomain' ),
        'new_item'           => __( 'Nouvelle Photo', 'textdomain' ),
        'edit_item'          => __( 'Editer une Photo', 'textdomain' ),
        'view_item'          => __( 'Voir  une Photo', 'textdomain' ),
        'all_items'          => __( 'Toutes les Photos', 'textdomain' ),
        'search_items'       => __( 'Rechercher dans les Photos', 'textdomain' ),
        'parent_item_colon'  => __( 'Parent de  la Photo:', 'textdomain' ),
        'not_found'          => __( 'Aucune Photo trouvée.', 'textdomain' ),
        'not_found_in_trash' => __( 'Aucune Photo trouvée dans la corbeille.', 'textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'photo' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'taxonomies'         => array( 'categorie', 'format' ),
        'menu_icon'          => 'dashicons-format-image', // Icone du menu
        'show_in_rest'       => true // Permet l'accès via l'API REST
    );
    register_post_type( 'photo', $args );
}
add_action( 'init', 'create_custom_photo_post' );

// Création des taxonomies

function create_photo_taxonomies() {
    $args = array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => 'Formats',
            'singular_name'     => 'Format',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'formate' ),
    );
    register_taxonomy( 'formate', 'photo', $args );
    $args = array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => 'Catégories',
            'singular_name'     => 'Catégorie',
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categorie' ),
    );
    register_taxonomy( 'categorie', 'photo', $args );
}
add_action( 'init', 'create_photo_taxonomies' );


/***********************************************************************************************************************/

