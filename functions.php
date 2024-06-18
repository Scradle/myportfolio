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

    // Enregistrer les styles
    wp_enqueue_style( 'style', THEME_URI."/style.css" , array(), ASSETS_VERSION );
    wp_enqueue_style( 'custom-style', THEME_URI . '/assets/css/custom-style.css', array(), ASSETS_VERSION );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

// Ajoute la prise en charge des modèles de page personnalisés
add_theme_support('custom-page-templates');
add_theme_support('post-thumbnails');

// Désactiver Gutenberg pour un type de publication personnalisé
function disabled_gutenberg_cpt( $use_block_editor, $post_type ) {
    if ( 'competence' === $post_type ) {
        return false;
    }
    return $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'disabled_gutenberg_cpt', 10, 2 );

/******************************************************************************************************************/

// Création d'un custom post type pour les compétences
function create_custom_competence_post() {
    $labels = array(
        'name'               => _x( 'compétences', 'post type general name', 'textdomain' ),
        'singular_name'      => _x( 'compétence', 'post type singular name', 'textdomain' ),
        'menu_name'          => _x( 'Compétence ', 'admin menu', 'textdomain' ),
        'name_admin_bar'     => _x( 'Compétences ', 'add new on admin bar', 'textdomain' ),
        'add_new'            => _x( 'Ajouter', 'custom post', 'textdomain' ),
        'add_new_item'       => __( 'Ajouter une nouvelle Compétence', 'textdomain' ),
        'new_item'           => __( 'Nouvelle Compétence', 'textdomain' ),
        'edit_item'          => __( 'Editer une Compétence', 'textdomain' ),
        'view_item'          => __( 'Voir  une Compétence', 'textdomain' ),
        'all_items'          => __( 'Toutes les Compétences', 'textdomain' ),
        'search_items'       => __( 'Rechercher dans les Compétences', 'textdomain' ),
        'parent_item_colon'  => __( 'Parent de  la Compétences:', 'textdomain' ),
        'not_found'          => __( 'Aucune Compétence trouvée.', 'textdomain' ),
        'not_found_in_trash' => __( 'Aucune Compétence trouvée dans la corbeille.', 'textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'competence' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'menu_icon'          => 'dashicons-welcome-learn-more', // Icone du menu
        'show_in_rest'       => true // Permet l'accès via l'API REST
    );
    register_post_type( 'competence', $args );
}
add_action( 'init', 'create_custom_competence_post' );




/***********************************************************************************************************************/

