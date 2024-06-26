/*scroll de section en section*****************************************************************************************************************************************/

// Ajout d'un écouteur d'événement pour s'assurer que le DOM est complètement chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', function () {

    // Sélection de toutes les sections de la page
    let sections = document.querySelectorAll('.section');
    
    // Index de la section actuellement visible
    let currentSectionIndex = 0;
    
    // Indicateur pour savoir si une opération de défilement est en cours
    let isScrolling = false;

    // Fonction pour faire défiler la page vers une section spécifique
    function scrollToSection(index) {
        // Correction de l'index pour la boucle infinie
        if (index >= sections.length) {
            index = 0; // Si l'index dépasse le nombre de sections, retourne à la première section
        } else if (index < 0) {
            index = sections.length - 1; // Si l'index est négatif, retourne à la dernière section
        }

        isScrolling = true; // Indique qu'un défilement est en cours
        
        // Défilement vers la section spécifiée avec une animation fluide
        sections[index].scrollIntoView({ behavior: 'smooth' });
                
        // Utilisation de setTimeout pour réinitialiser isScrolling après 1 seconde (temps d'animation estimé)
        setTimeout(() => { 
            isScrolling = false; 
            currentSectionIndex = index; // Mise à jour de l'index de la section actuelle après le défilement
        }, 500);
    }

    // Ajout d'un écouteur d'événement pour le défilement de la souris
    document.addEventListener('wheel', function (event) {
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

        // Appelle la fonction pour faire défiler vers la nouvelle section
        scrollToSection(currentSectionIndex);
    }, { passive: false }); // Le paramètre passive: false permet de prévenir le comportement par défaut du navigateur pour l'événement wheel
});

/*menu vertical****************************************************************************************************************************************************************/

// Ajout d'un écouteur d'événement pour s'assurer que le DOM est complètement chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', function () {

    // Sélection de toutes les sections de la page et du bouton du cta
    let sections = document.querySelectorAll('.section');
    let contactButton = document.querySelector('.contact-button');

    // Sélection des liens du menu de navigation
    let navLinks = document.querySelectorAll('#vertical-menu a');

    // Index de la section actuellement visible
    let currentSectionIndex = 0;

    // Indicateur pour savoir si une opération de défilement est en cours
    let isScrolling = false;

    // Fonction pour faire défiler la page vers une section spécifique
    function scrollToSection(index) {
        // Correction de l'index pour la boucle infinie
        if (index >= sections.length) {
            index = 0; // Si l'index dépasse le nombre de sections, retourne à la première section
        } else if (index < 0) {
            index = sections.length - 1; // Si l'index est négatif, retourne à la dernière section
        }

        isScrolling = true; // Indique qu'un défilement est en cours

        // Défilement vers la section spécifiée avec une animation fluide
        sections[index].scrollIntoView({ behavior: 'smooth' });

        // Utilisation de setTimeout pour réinitialiser isScrolling après 1 seconde (temps d'animation estimé)
        setTimeout(() => {
            isScrolling = false;
            currentSectionIndex = index; // Mise à jour de l'index de la section actuelle après le défilement

            // Met à jour les liens du menu de navigation
            updateNavLinks();
        }, 500);
    }

    // Fonction pour mettre à jour les liens du menu de navigation
    function updateNavLinks() {
        // Retire la classe 'active' de tous les liens
        navLinks.forEach(link => link.classList.remove('active'));

        // Ajoute la classe 'active' au lien correspondant à la section actuelle
        navLinks[currentSectionIndex].classList.add('active');
    }

    // Ajout d'un écouteur d'événement pour le défilement de la souris
    document.addEventListener('wheel', function (event) {
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

        // Appelle la fonction pour faire défiler vers la nouvelle section
        scrollToSection(currentSectionIndex);
    }, { passive: false }); // Le paramètre passive: false permet de prévenir le comportement par défaut du navigateur pour l'événement wheel

    // Ajout d'un écouteur d'événement pour les clics sur les liens du menu de navigation
    navLinks.forEach((link, index) => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            currentSectionIndex = index;
            scrollToSection(currentSectionIndex);
        });
    });

    // Ajout d'un écouteur d'événement pour les clics sur le call to action
    contactButton.addEventListener('click', function (event) {
        event.preventDefault();
        currentSectionIndex = 3;
        scrollToSection(currentSectionIndex);
    });

    // Met à jour les liens du menu de navigation lors du chargement initial de la page
    updateNavLinks();
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

// Sélectionnez la vidéo et définissez les options pour l'intersection observer
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


/*animations****************************************************************************************************************************************************************/

// Attendre que le contenu du DOM soit complètement chargé avant d'exécuter le script et afficher le titre
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
      span.innerText = text[i];

      // Ajouter la classe "title" au <span> pour appliquer les styles CSS
      span.className = "title";

      // Définir les délais d'animation pour le fade-in et glow
      span.style.animationDelay = `${i * 0.25}s, 0s`;

      // Ajouter le <span> au titre
      title.appendChild(span);
    }
});


// Attend que le DOM soit entièrement chargé pour gérer les bandes
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

    // Fonction pour mettre à jour la position des bandes verticales en fonction de l'index de section
    function updateStripesPosition(index) {
        switch(index) {
            case 0:
                moveStripesTo('0%', '0%', '0%');
                break;
            case 1:
                moveStripesTo('20%', '25%', '30%');
                break;
            case 2:
                moveStripesTo('40%', '45%', '50%');
                break;
            case 3:
                moveStripesTo('65%', '65%', '70%');
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
            index = 0; // Si l'index dépasse le nombre de sections, retourne à la première section
        } else if (index < 0) {
            index = sections.length - 1; // Si l'index est négatif, retourne à la dernière section
        }

        isScrolling = true; // Indique qu'un défilement est en cours
        
        // Défilement vers la section spécifiée avec une animation fluide
        sections[index].scrollIntoView({ behavior: 'smooth' });
                
        // Utilisation de setTimeout pour réinitialiser isScrolling après 1 seconde (temps d'animation estimé)
        setTimeout(() => { 
            isScrolling = false; 
            currentSectionIndex = index; // Mise à jour de l'index de la section actuelle après le défilement
        }, 500);
        
        // Met à jour la position des bandes verticales en fonction de la nouvelle section
        updateStripesPosition(index);
    }

    // Ajout d'un écouteur d'événement pour le défilement de la souris
    document.addEventListener('wheel', function (event) {
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

        // Appelle la fonction pour faire défiler vers la nouvelle section
        scrollToSection(currentSectionIndex);
    }, { passive: false }); // Le paramètre passive: false permet de prévenir le comportement par défaut du navigateur pour l'événement wheel

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
});
