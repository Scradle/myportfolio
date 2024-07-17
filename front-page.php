<?php
$context = Timber::context();

// Informations sur le site
$context['site'] = array(
    'charset' => get_bloginfo('charset'),
    'name' => get_bloginfo('name'),
);

// Titre de la page
$context['title'] = get_the_title();

// Récupération des compétences
$args_competences = array(
    'post_type' => 'competence',
    'posts_per_page' => -1
);
$competences_query = new WP_Query($args_competences);

$competences = array();
// Tableau avec toutes les compétences et leurs champs acf
if ($competences_query->have_posts()) {
    while ($competences_query->have_posts()) {
        $competences_query->the_post();
        $logo = get_field('logo'); 
        $description = get_field('description'); 
        $competences[] = array(
            'title' => get_the_title(),
            'logo' => $logo,
            'description' => $description,
        );
    }
    wp_reset_postdata();
}

// Créez plusieurs copies mélangées des compétences
$shuffled_competences_sets = array();
for ($i = 0; $i < 4; $i++) {
    $shuffled_competences = $competences;
    shuffle($shuffled_competences);
    $shuffled_competences_sets[] = $shuffled_competences;
}

$context['shuffled_competences_sets'] = $shuffled_competences_sets;

// Récupération de la dernière réalisation
$args_realisation = array(
    'post_type' => 'realisation',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC'
);
$realisations = Timber::get_posts($args_realisation);
$context['realisation'] = $realisations ? $realisations[0] : null;

// Variables pour les images (définies en dur)
$context['image_ids'] = array(
    'linkedin' => 168,
    'github' => 167,
    'photo1' => 162,
    'photo2' => 164,
    'photo_competences' => 163,
    'previous_arrow' => 165,
    'next_arrow' => 166,
    'contact_form_icon' => 167,
);

Timber::render('front-page.twig', $context);

