<?php
// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

// Initialize Timber.
Timber\Timber::init();


// Ajoute une fonction personnalisée à Timber pour appeler do_shortcode.
add_filter( 'timber/twig', function( \Twig\Environment $twig ) {
    $twig->addFunction( new \Twig\TwigFunction( 'do_shortcode', 'do_shortcode' ) );
    return $twig;
} );

/******************************************************************************************************************/

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

    wp_localize_script('ajax-script', 'ajax_object', [
		'ajax_url' 					=> admin_url( 'admin-ajax.php' ),
	]); 

    // Enregistrer les styles
    wp_enqueue_style( 'style', THEME_URI."/style.css" , array(), ASSETS_VERSION );
    wp_enqueue_style( 'custom-style', THEME_URI . '/assets/css/custom-style.min.css', array(), ASSETS_VERSION );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

// Désactiver Gutenberg pour un type de publication personnalisé
function disabled_gutenberg_cpt( $use_block_editor, $post_type ) {
    // Liste des types de contenu personnalisé pour lesquels vous souhaitez désactiver l'éditeur de blocs
    $disabled_post_types = array( 'competence', 'realisation' );

    // Vérifier si le type de contenu actuel est dans la liste des types désactivés
    if ( in_array( $post_type, $disabled_post_types, true ) ) {
        return false;
    }

    return $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'disabled_gutenberg_cpt', 10, 2 );

// Ajout du support pour la balise de titre
function theme_setup() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_setup');


/******************************************************************************************************************/

// Création d'un custom post type pour les compétences
function create_custom_competence_post() {
    $labels = array(
        'name'               => _x( 'compétences', 'post type general name', 'textdomain' ),
        'singular_name'      => _x( 'compétence', 'post type singular name', 'textdomain' ),
        'menu_name'          => _x( 'Compétence ', 'admin menu', 'textdomain' ),
        'name_admin_bar'     => _x( 'Compétence ', 'add new on admin bar', 'textdomain' ),
        'add_new'            => _x( 'Ajouter', 'custom post', 'textdomain' ),
        'add_new_item'       => __( 'Ajouter une nouvelle Compétence', 'textdomain' ),
        'new_item'           => __( 'Nouvelle Compétence', 'textdomain' ),
        'edit_item'          => __( 'Editer une Compétence', 'textdomain' ),
        'view_item'          => __( 'Voir  une Compétence', 'textdomain' ),
        'all_items'          => __( 'Toutes les Compétences', 'textdomain' ),
        'search_items'       => __( 'Rechercher dans les Compétences', 'textdomain' ),
        'parent_item_colon'  => __( 'Parent de  la Compétence:', 'textdomain' ),
        'not_found'          => __( 'Aucune Compétence trouvée.', 'textdomain' ),
        'not_found_in_trash' => __( 'Aucune Compétence trouvée dans la corbeille.', 'textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false,
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

// Création d'un custom post type pour les réalisations
function create_custom_realisation_post() {
    $labels = array(
        'name'               => _x( 'réalisations', 'post type general name', 'textdomain' ),
        'singular_name'      => _x( 'réalisation', 'post type singular name', 'textdomain' ),
        'menu_name'          => _x( 'Réalisation ', 'admin menu', 'textdomain' ),
        'name_admin_bar'     => _x( 'Réalisations ', 'add new on admin bar', 'textdomain' ),
        'add_new'            => _x( 'Ajouter', 'custom post', 'textdomain' ),
        'add_new_item'       => __( 'Ajouter une nouvelle Réalisation', 'textdomain' ),
        'new_item'           => __( 'Nouvelle Réalisation', 'textdomain' ),
        'edit_item'          => __( 'Editer une Réalisation', 'textdomain' ),
        'view_item'          => __( 'Voir  une Réalisation', 'textdomain' ),
        'all_items'          => __( 'Toutes les Réalisations', 'textdomain' ),
        'search_items'       => __( 'Rechercher dans les Réalisations', 'textdomain' ),
        'parent_item_colon'  => __( 'Parent de  la Réalisation:', 'textdomain' ),
        'not_found'          => __( 'Aucune Réalisation trouvée.', 'textdomain' ),
        'not_found_in_trash' => __( 'Aucune Réalisation trouvée dans la corbeille.', 'textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'realisation' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'menu_icon'          => 'dashicons-welcome-widgets-menus', // Icone du menu
        'show_in_rest'       => true // Permet l'accès via l'API REST
    );
    register_post_type( 'realisation', $args );
}
add_action( 'init', 'create_custom_realisation_post' );

/***********************************************************************************************************************/

// Fonction pour récupérer toutes les informations des articles du CPT "realisation"
function fetch_portfolio_items() {
    $args = array(
        'post_type' => 'realisation',
        'posts_per_page' => -1, // Récupérer tous les articles
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $query = new WP_Query($args);
    $portfolio_items = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Récupérer les champs ACF ou autres champs nécessaires
            $screenshot = get_field('screenshot');
            $video = get_field('video'); 
            $link = get_field('link');
            $techno = get_field('techno');
            $objectif = get_field('objectif');
            $item = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'date' => ucfirst(get_the_date('F Y')),
                'screenshot' => $screenshot,
                'video' => $video,
                'link' => $link,
                'techno' => $techno,
                'objectif' => $objectif,
            );
            $portfolio_items[] = $item;
        }
    }

    wp_reset_postdata();

    // Retourner les articles au format JSON
    wp_send_json($portfolio_items);
    exit;
}

add_action('wp_ajax_fetch_portfolio_items', 'fetch_portfolio_items');
add_action('wp_ajax_nopriv_fetch_portfolio_items', 'fetch_portfolio_items');
