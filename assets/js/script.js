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

// Déclaration des liens du menu de navigation en dehors de la fonction DOMContentLoaded pour être accessible dans toute la portée du script
let navLinks;

document.addEventListener('DOMContentLoaded', function () {

    // Sélection de toutes les sections de la page
    let sections = document.querySelectorAll('.section');

    // Sélection des liens du menu de navigation
    navLinks = document.querySelectorAll('#vertical-menu a');

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

    // Met à jour les liens du menu de navigation lors du chargement initial de la page
    updateNavLinks();
});
