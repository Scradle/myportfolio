<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ( is_home() || is_front_page() ) ? get_bloginfo( 'name' ) : wp_title( '', false ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <nav id="vertical-menu">
        <a href="#presentation">Présentation</a>
        <a href="#competences">Compétences</a>
        <a href="#realisations">Réalisations</a>
        <a href="#contact">Contactez moi</a>
    </nav>
    <div class="vertical-stripe stripe1"></div>
    <div class="vertical-stripe stripe2"></div>
    <div class="vertical-stripe stripe3"></div>
</header> 