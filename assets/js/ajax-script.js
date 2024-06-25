document.addEventListener('DOMContentLoaded', function() {
    var portfolioRealisation = document.getElementById('portfolio-realisation');
    var portfolioItems = []; // Tableau pour stocker les informations des articles
    var totalItems = 0; // Variable pour stocker le nombre total d'articles

    // Fonction pour récupérer toutes les informations des articles au chargement de la page
    function fetchAllPortfolioItems() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', ajax_object.ajax_url);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                portfolioItems = JSON.parse(xhr.responseText); // Stocker les articles dans le tableau
                totalItems = portfolioItems.length;
                initializePortfolioRealisation(); // Initialiser la première section portfolio
            }
        };
        xhr.send('action=fetch_portfolio_items');
    }

    // Appeler la fonction pour récupérer toutes les informations des articles
    fetchAllPortfolioItems();

    // Écouteurs d'événements pour les icones Précédent et Suivant
    document.addEventListener('click', function(e) {
        if (e.target.closest('.previous-btn img')) {
            e.preventDefault();
            navigatePortfolioItems('previous');
        }
        if (e.target.closest('.next-btn img')) {
            e.preventDefault();
            navigatePortfolioItems('next');
        }
    });

    // Fonction pour naviguer entre les articles
    function navigatePortfolioItems(direction) {
        var currentPostId = parseInt(portfolioRealisation.getAttribute('data-current-post-id'));
        var currentIndex = findIndexById(currentPostId);
        var newIndex;

        if (direction === 'next') {
            newIndex = currentIndex + 1;
            if (newIndex >= totalItems) {
                newIndex = 0; // Revenir au premier article
            }
        } else if (direction === 'previous') {
            newIndex = currentIndex - 1;
            if (newIndex < 0) {
                newIndex = totalItems - 1; // Aller au dernier article
            }
        }

        if (newIndex >= 0 && newIndex < totalItems) {
            var newItem = portfolioItems[newIndex];
            updatePortfolioRealisation(newItem);
        }
    }

    // Fonction pour trouver l'index d'un article dans le tableau par son ID
    function findIndexById(id) {
        for (var i = 0; i < portfolioItems.length; i++) {
            if (portfolioItems[i].id === id) {
                return i;
            }
        }
        return -1;
    }

    // Fonction pour initialiser la section portfolio avec le premier article
    function initializePortfolioRealisation() {
        if (portfolioItems.length > 0) {
            var firstItem = portfolioItems[0];
            updatePortfolioRealisation(firstItem);
        }
    }

    // Fonction pour mettre à jour la section portfolio avec les informations d'un nouvel article
    function updatePortfolioRealisation(item) {
        portfolioRealisation.setAttribute('data-current-post-id', item.id);
        portfolioRealisation.querySelector('.left-block img').src = item.screenshot;
        portfolioRealisation.querySelector('.info-block .realisation-title').textContent = item.title;
        portfolioRealisation.querySelector('.info-block p:nth-of-type(1)').textContent = item.date;
        portfolioRealisation.querySelector('.info-block p:nth-of-type(2)').textContent = item.techno;
        portfolioRealisation.querySelector('.info-block p:nth-of-type(3)').textContent = item.objectif;
    }
});
