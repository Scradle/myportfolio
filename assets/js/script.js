/*scroll de section en section avec gestion du menu et des stripes*****************************************************************************************************************************************/

// Attend que le DOM soit entièrement chargé pour démarrer le script
document.addEventListener('DOMContentLoaded', function () {

    // Sélection de toutes les sections de la page
    let sections = document.querySelectorAll('.section');
    
    // Index de la section actuellement visible
    let currentSectionIndex = 0;
    
    // Indicateur pour savoir si une opération de défilement est en cours
    let isScrolling = false;

    // Sélectionne les éléments des bandes verticales
    const stripe1 = document.querySelector('.stripe1');
    const stripe2 = document.querySelector('.stripe2');
    const stripe3 = document.querySelector('.stripe3');

    // Sélectionne les liens du menu de navigation vertical
    let navLinks = document.querySelectorAll('#vertical-menu a');

    // Sélectionne le bouton du call to action (CTA)
    let contactButton = document.querySelector('.contact-button');

    // Fonction throttle pour limiter la fréquence d'exécution
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    // Fonction pour mettre à jour la position des bandes verticales en fonction de l'index de section
    function updateStripesPosition(index) {
        switch(index) {
            case 0:
                moveStripesTo('65%', '65%', '70%');
                break;
            case 1:
                moveStripesTo('0%', '25%', '95%');
                break;
            case 2:
                moveStripesTo('40%', '45%', '50%');
                break;
            case 3:
                moveStripesTo('15%', '20%', '55%');
                break;
            default:
                break;
        }
    }
    
    // Fonction pour déplacer les bandes vers une nouvelle position avec transition CSS
    function moveStripesTo(left1, left2, left3) {
        stripe1.style.transition = 'left 0.5s ease-in-out';
        stripe2.style.transition = 'left 0.5s ease-in-out';
        stripe3.style.transition = 'left 0.5s ease-in-out';
        
        stripe1.style.left = left1;
        stripe2.style.left = left2;
        stripe3.style.left = left3;
    }

    // Fonction pour faire défiler la page vers une section spécifique
    function scrollToSection(index) {
        // Correction de l'index pour la boucle infinie
        if (index >= sections.length) {
            index = 0; // Revenir à la première section si l'index dépasse la longueur des sections
        } else if (index < 0) {
            index = sections.length - 1; // Aller à la dernière section si l'index est négatif
        }

        isScrolling = true; // Indique qu'un défilement est en cours
        
        // Défilement vers la section spécifiée avec une animation fluide
        sections[index].scrollIntoView({ behavior: 'smooth' });
                
        // Utilisation de setTimeout pour réinitialiser isScrolling après 500ms (estimation du temps d'animation)
        setTimeout(() => { 
            isScrolling = false; 
            currentSectionIndex = index; // Mettre à jour l'index de la section actuelle après le défilement
        }, 500);
        
        // Mettre à jour la position des bandes verticales en fonction de la nouvelle section
        updateStripesPosition(index);

        // Mettre à jour les liens du menu de navigation
        updateNavLinks(index);
    }

    // Fonction pour mettre à jour les liens du menu de navigation
    function updateNavLinks(index) {
        // Retire la classe 'active' de tous les liens
        navLinks.forEach(link => link.classList.remove('active'));
        
        // Ajoute la classe 'active' au lien correspondant à la section actuelle
        if (index !== undefined) {
            navLinks[index].classList.add('active');
        } else {
            navLinks[currentSectionIndex].classList.add('active');
        }
    }

    // Ajout d'un écouteur d'événement pour le défilement de la souris (utilisation de throttle)
    document.addEventListener('wheel', throttle(function(event) {
        // Si un défilement est déjà en cours, ignorer les nouveaux événements de défilement
        if (isScrolling) return;

        // Détection de la direction du défilement
        if (event.deltaY > 0) {
            // Défilement vers le bas
            currentSectionIndex++;
        } else {
            // Défilement vers le haut
            currentSectionIndex--;
        }

        // Appeler la fonction pour faire défiler vers la nouvelle section
        scrollToSection(currentSectionIndex);
    }, 700)); // Limite de throttle

    // Ajout d'un écouteur d'événement pour les clics sur les liens du menu de navigation
    navLinks.forEach((link, index) => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            currentSectionIndex = index;
            scrollToSection(currentSectionIndex);
        });
    });

    // Ajout d'un écouteur d'événement pour les clics sur le call to action (CTA)
    contactButton.addEventListener('click', function (event) {
        event.preventDefault();
        currentSectionIndex = 3; // Remplacez avec l'index de votre section CTA
        scrollToSection(currentSectionIndex);
    });

    // Sélectionne tous les liens d'ancrage vers les sections
    const links = document.querySelectorAll('a[href^="#"]');
    
    // Écoute les clics sur les liens d'ancrage
    links.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            
            // Récupère l'ancre vers laquelle le lien pointe
            const anchor = link.getAttribute('href');
            
            // Trouve l'index de la section correspondant à l'ancre
            const index = Array.from(sections).findIndex(section => `#${section.id}` === anchor);
            
            // Si l'index est trouvé, fait défiler la page vers cette section
            if (index !== -1) {
                scrollToSection(index);
            }
        });
    });

    // Position initiale des bandes verticales au chargement de la page
    updateStripesPosition(currentSectionIndex);
    
    // Mise à jour initiale des liens du menu de navigation
    updateNavLinks(currentSectionIndex);
});




/*boucles compétences****************************************************************************************************************************************************************/

// Duplique les éléments de chaque boucle 
document.addEventListener('DOMContentLoaded', function() {
    const sliders = document.querySelectorAll('.loop-slider .inner');
    sliders.forEach(slider => {
        const clone = slider.innerHTML;
        slider.innerHTML += clone;
    });
});


// Affichage de la compétence sélectionnée
document.addEventListener('DOMContentLoaded', function() {
    const skills = document.querySelectorAll('.skill');
    const baseText = document.querySelector('.base-text');
    const logoContainer = document.querySelector('.text-area .logo-container');
    const competenceTitle = document.querySelector('.text-area .competence-title');
    const competenceDescription = document.querySelector('.text-area .competence-description');

    skills.forEach(skill => {
        skill.addEventListener('click', function() {
            const title = skill.getAttribute('data-title');
            const logo = skill.getAttribute('data-logo');
            const description = skill.getAttribute('data-description');

            // Effacer ou cacher le texte de base
            baseText.style.display = 'none';

            // Mettre à jour la zone de texte
            logoContainer.innerHTML = `<img src="${logo}" alt="logo de ${title}">`;
            competenceTitle.textContent = title;
            competenceDescription.textContent = description;
        });
    });
});

/*videos****************************************************************************************************************************************************************/

// Sélectionne la vidéo et définir les options pour l'intersection observer
const video = document.getElementById('myVideo');
const options = {
    root: null, // utilise le viewport comme la zone d'observation
    rootMargin: '0px', // marge autour de l'élément observé
    threshold: 1.0 // déclenche lorsque l'élément est entièrement visible
};

// Créer un observer avec une fonction de callback
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // L'élément est complètement visible, démarrer la vidéo
            video.play();
        } else {
            // L'élément n'est pas visible, mettre en pause la vidéo
            video.pause();
        }
    });
}, options);

// Observer la vidéo
observer.observe(video);


/*animation du titre****************************************************************************************************************************************************************/

// Attend que le DOM soit entièrement chargé pour démarrer le script
document.addEventListener("DOMContentLoaded", () => {
    // Sélectionner l'élément du titre par son ID
    const title = document.getElementById("animated-title");

    // Récupérer le texte contenu dans l'élément du titre
    const text = title.innerText;

    // Effacer le texte initial dans l'élément du titre
    title.innerHTML = "";

    // Boucle à travers chaque caractère du texte
    for (let i = 0; i < text.length; i++) {
        // Créer un nouvel élément <span> pour chaque caractère
        const span = document.createElement("span");

        // Définir le texte du <span> au caractère courant
        // Si le caractère est un espace, utiliser une espace insécable (&nbsp;)
        if (text[i] === " ") {
            span.innerHTML = "&nbsp;";
        } else {
            span.innerText = text[i];
        }

        // Ajouter la classe "title" au <span> pour appliquer les styles CSS
        span.className = "title";

        // Définir les délais d'animation pour le fade-in et glow
        span.style.animationDelay = `${i * 0.05}s, 0s`;

        // Ajouter le <span> au titre
        title.appendChild(span);
    }
});


/*gestion des alt****************************************************************************************************************************************************************/

// Attend que le DOM soit entièrement chargé pour démarrer le script
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionne toutes les images ayant la classe 'hover-image'
    var images = document.querySelectorAll('.hover-image');

    // Parcourt chaque image sélectionnée
    images.forEach(function(image) {
        // Ajoute un écouteur d'événement pour l'événement 'mouseover' (quand la souris survole l'image)
        image.addEventListener('mouseover', function(event) {
            // Crée un nouvel élément 'div' pour le tooltip
            var tooltip = document.createElement('div');
            // Attribue la classe 'tooltip' au nouvel élément 'div'
            tooltip.className = 'tooltip';
            // Définit le texte du tooltip en utilisant l'attribut 'alt' de l'image
            tooltip.textContent = image.alt;
            // Ajoute le tooltip au corps du document
            document.body.appendChild(tooltip);

            // Récupère les dimensions et la position de l'image
            var rect = image.getBoundingClientRect();
            // Positionne le tooltip au-dessus de l'image et le centre horizontalement
            tooltip.style.left = rect.left + (rect.width - tooltip.offsetWidth) / 2 + 'px';
            tooltip.style.top = rect.top - tooltip.offsetHeight + 'px';

            // Utilisez un léger délai pour déclencher l'effet de fade-in
            setTimeout(function() {
                // Assurez-vous que le tooltip est affiché
                tooltip.style.display = 'block';
                // Déclenchez l'effet de fade-in en réglant l'opacité
                tooltip.style.opacity = 0.8;
            }, 10); // 10ms pour que le navigateur prenne en compte le display: block
        });

        // Ajoute un écouteur d'événement pour l'événement 'mousemove' (quand la souris se déplace sur l'image)
        image.addEventListener('mousemove', function(event) {
            // Sélectionne le tooltip
            var tooltip = document.querySelector('.tooltip');
            if (tooltip) {
                // Positionne le tooltip par rapport à la position de la souris, avec un décalage
                tooltip.style.left = event.pageX + 10 + 'px';
                tooltip.style.top = event.pageY - 40 + 'px';
            }
        });

        // Ajoute un écouteur d'événement pour l'événement 'mouseout' (quand la souris quitte l'image)
        image.addEventListener('mouseout', function() {
            // Sélectionne le tooltip
            var tooltip = document.querySelector('.tooltip');
            if (tooltip) {
                // Supprime le tooltip immédiatement sans effet de fade-out
                tooltip.remove();
            }
        });
    });
});
