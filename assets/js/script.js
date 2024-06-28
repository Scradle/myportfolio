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