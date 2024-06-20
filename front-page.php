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

    <div class="background2" >  <!--background2-->
        <ul class="circles2a">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <ul class="circles2b">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div >

    <div class="text-area">
        <div class="logo-container">
        </div>
        <div class="text-content">
            <p class="base-text">Je vous invite à cliquer sur les logos représentant les divers environnements, langages de programmation et logiciels que j'utilise dans mon workflow quotidien. Chaque logo est un élément clé de mon processus de travail et reflète les compétences que j'ai développées au fil du temps.</p>
            <div class="competence-title"></div>
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

    
    <?php
    $args = array(
        'post_type' => 'realisation',
        'posts_per_page' => 1, // Un seul article par page, pour la navigation
        'orderby' => 'date',
        'order' => 'DESC', // Afficher l'article le plus récent en premier
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            // Récupération des champs ACF nécessaires
            $screenshot = get_field('screenshot');
            $techno = get_field('techno');
            $objectif = get_field('objectif');
            $permalink = get_permalink();
            ?>

            <div class="bloc-realisation" id="portfolio-realisation" data-current-post-id="<?php the_ID(); ?>">
                <div class="left-block">
                    <a href="<?php echo esc_url($permalink); ?>">
                        <img src="<?php echo esc_url($screenshot); ?>" alt="Screenshot">
                    </a>
                </div>
                <div class="right-block">
                    <div class="info-block">
                        <div class="realisation-title"><?php the_title(); ?></div>
                        <p>Date de publication: <?php echo get_the_date(); ?></p>
                        <p><?php echo $techno; ?></p>
                        <p><?php echo $objectif; ?></p>
                    </div>
                    <div class="bloc-nav">
                        <div class="previous-btn"><img src="<?php echo get_template_directory_uri() . '/assets/images/circle-left-solid.svg'; ?>" alt="Flêche de gauche"></div>
                        <div class="next-btn"><img src="<?php echo get_template_directory_uri() . '/assets/images/circle-right-solid.svg'; ?>" alt="flêche de droite"></div>
                    </div>
                </div>
            </div>

        <?php
        endwhile;
        wp_reset_postdata();
        else :
            ?>
            <p><?php _e('Aucune réalisation trouvée'); ?></p>
        <?php endif; ?>
    

</section>


<?php
get_footer();