<?php
get_header();
?>


<section id="presentation" class="section">
    <div class="background1" >  <!--background1-->
        <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
        </ul>
    </div >
    <div class="container">
        <div class="text-block">
            <div class="hello-world">Hello world!</div>            
            <p>
                Je m'appelle <span class="highlight">Guillaume</span>, développeur web spécialisé 
                <span class="highlight">WordPress</span>. Passionné par la <span class="highlight">création</span>, 
                l'<span class="highlight">exploration</span> et l'<span class="highlight">innovation</span>, 
                j'ai choisi de me reconvertir dans le développement web pour donner vie à vos idées. 
                Mon expertise me permet de concevoir des sites <span class="highlight">performants</span>, 
                <span class="highlight">élégants</span> et <span class="highlight">sur-mesure</span>. 
                Chaque projet est pour moi une nouvelle aventure, où je mets à profit ma <span class="highlight">créativité</span>
                 et ma <span class="highlight">curiosité</span> pour repousser les limites du 
                <span class="highlight">design</span> et du développement web.
            </p>
            <a href="#" class="contact-button">Ensemble, faisons de votre présence en ligne une expérience inoubliable.</a>
        </div>
        <div class="image-block">
            <img src="<?php echo get_template_directory_uri() . './assets/images/logodev1.webp'; ?>" alt="illustration de la présentation">
        </div>
    </div>
</section>

<section id="competences" class="section">
    <div class="text-area">
        <div class="logo-container">
        </div>
        <div class="text-content">
            <!-- Texte de base -->
            <p class="base-text">Je vous invite à cliquer sur les logos représentant les divers environnements, langages de programmation et logiciels que j'utilise dans mon workflow quotidien. Chaque logo est un élément clé de mon processus de travail et reflète les compétences que j'ai développées au fil du temps.</p>
            <p class="competence-title"></p>
            <p class="competence-description"></p>
        </div>
    </div>
    <?php

    // Récupérer toutes les compétences
    $args = array(
        'post_type' => 'competence',
        'posts_per_page' => -1
    );
    $competences_query = new WP_Query($args);

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
    ?>

    <div class="skill-list">
        <?php for ($i = 0; $i < 4; $i++) : 
          // Mélanger les compétences avant de remplir chaque inner
          $shuffled_competences = $competences;
          shuffle($shuffled_competences);
        ?>
            <div class="loop-slider slider-<?php echo $i + 1; ?>">
                <!--4 sliders crées et remplis dynamiquements-->
                <div class="inner">
                    <?php foreach ($shuffled_competences as $competence) : ?>
                        <div class="skill" data-title="<?php echo esc_attr($competence['title']); ?>" data-logo="<?php echo esc_url($competence['logo']); ?>" data-description="<?php echo esc_attr($competence['description']); ?>">
                            <img src="<?php echo esc_url($competence['logo']); ?>" alt="logo de <?php echo esc_attr($competence['title']); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endfor; ?>
        <div class="fade"></div>
    </div>
    
</section>

<section id="realisations" class="section">
    <div class="background3" >  <!--background3-->
        <ul class="circles3">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
        </ul>
    </div >
</section>


<?php
get_footer();