<?php
get_header();
?>


<section id="presentation" class="section">
    <div class="background1" >  <!--background1-->
        <div class="circles">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div >
    <div class="container">
        <div class="text-block">
            <h1 id="animated-title">Hello world!</h1>            
            <p>
                Je m'appelle <span class="highlight">Guillaume</span>, développeur web spécialisé 
                <span class="highlight">WordPress</span>.<br> Passionné par la <span class="highlight">création</span>, 
                l'<span class="highlight">exploration</span> et l'<span class="highlight">innovation</span>, 
                j'ai choisi de me reconvertir dans le développement web pour donner vie à vos idées.<br> 
                Mon expertise me permet de concevoir des sites <span class="highlight">performants</span>, 
                <span class="highlight">élégants</span> et <span class="highlight">sur-mesure</span>.<br> 
                Chaque projet est pour moi une nouvelle aventure, où je mets à profit ma <span class="highlight">créativité</span>
                 et ma <span class="highlight">curiosité</span> pour repousser les limites du 
                <span class="highlight">design</span> et du développement web.
            </p>
            <div class="contact-icons">
                <a href="https://www.linkedin.com/in/guillaume-dufour-9a4758316/" class="icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . './assets/images/linkedin-me.webp'; ?>" class="icon-svg" alt="Mon LinkedIn">
                </a>
                <a href="https://github.com/Scradle" class="icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . './assets/images/github-me.webp'; ?>" class="icon-svg" alt="Mon GitHub">
                </a>
            </div>
            <a href="#" class="contact-button">Ensemble, faisons de votre présence en ligne une expérience inoubliable.</a>
        </div>
        <div class="image-block">
            <img src="<?php echo get_template_directory_uri() . './assets/images/logodev1.webp'; ?>" alt="illustration de la présentation">
        </div>
    </div>
</section>

<section id="competences" class="section">
    <div class="background2" >  <!--background2-->
        <div class="circles2a">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="circles2b">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div >

    <div class="text-area">
        <div class="logo-container">
        </div>
        <div class="text-content">
            <div class="base-text">
                <h2>Mes Compétences en Développement Web</h2>
                <p>Je vous invite à cliquer sur les logos représentant les divers environnements, langages de programmation et logiciels que j'utilise dans mon workflow quotidien. Chaque logo est un élément clé de mon processus de travail et reflète les compétences que j'ai développées au fil du temps.</p>
            </div>
            <h3 class="competence-title"></h3>
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
         
          shuffle($competences);
        ?>
            <div class="loop-slider slider-<?php echo $i + 1; ?>">
                <!--4 sliders crées et remplis dynamiquements-->
                <div class="inner">
                    <?php foreach ($competences as $competence) : ?>
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
        <div class="circles3a">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="circles3b">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
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
            $video = get_field('video');
            $link = get_field('link');
            $techno = get_field('techno');
            $objectif = get_field('objectif');
            ?>

            <div class="bloc-realisation" id="portfolio-realisation" data-current-post-id="<?php the_ID(); ?>">
                <h2>Mes Projets et Réalisations</h2>
                <div class="blocks">
                    <div class="left-block">
                        <?php if ($video) : ?>
                            <video id="myVideo" loop muted playsinline>
                                <source src="<?php echo esc_url($video); ?>" type="video/webm">
                                Your browser does not support the video tag.
                            </video>
                        <?php else : ?>
                            <img src="<?php echo esc_url($screenshot); ?>" alt="Screenshot">
                        <?php endif; ?>
                    </div>
                    <div class="right-block">
                        <div class="info-block">
                            <h3 class="realisation-title"><?php the_title(); ?></h3>
                            <p><?php echo ucfirst(get_the_date('F Y')); ?></p>
                            <a href="<?php echo $link; ?>" class="icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri() . './assets/images/github-me.webp'; ?>" class="icon-svg" alt="Mon GitHub">
                            </a>
                            <p><?php echo $techno; ?></p>
                            <p><?php echo $objectif; ?></p>
                        </div>
                        <div class="bloc-nav">
                            <div class="previous-btn"><img src="<?php echo get_template_directory_uri() . '/assets/images/circle-left-solid.svg'; ?>" alt="Flêche de gauche"></div>
                            <div class="next-btn"><img src="<?php echo get_template_directory_uri() . '/assets/images/circle-right-solid.svg'; ?>" alt="flêche de droite"></div>
                        </div>
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

<section id="contact" class="section">
    <div class="background4" >  <!--background4-->
        <div class="circles4">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="contact-bloc">
        <h2>Contactez-moi pour vos Projets</h2>
        <div class="contact-form">
            <?php echo do_shortcode('[contact-form-7 id="d9be59c" title="Form-contact"]'); ?> <!-- insertion du formulaire de demande de renseignements -->
        </div>
    </div>
</section>


<?php
get_footer();