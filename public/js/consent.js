document.addEventListener('DOMContentLoaded', function () {
    // Sélectionne l'élément HTML avec l'ID 'consent-banner', qui est la bannière de consentement.
    const consentBanner = document.getElementById('consent-banner');
    // Sélectionne l'élément HTML avec l'ID 'accept-consent', qui est le bouton "Accepter".
    const acceptButton = document.getElementById('accept-consent');
    // Sélectionne l'élément HTML avec l'ID 'reject-consent', qui est le bouton "Refuser".
    const rejectButton = document.getElementById('reject-consent');

    // Vérifier si l'utilisateur a déjà consenti ou refusé
    if (!localStorage.getItem('cookie-consent')) {
        // Si la clé n'existe pas, cela signifie que l'utilisateur n'a pas encore fait de choix, donc la bannière de consentement est affichée.
        consentBanner.style.display = 'block';
    }

    // Ajoute un écouteur d'événement au bouton "Accepter".
    acceptButton.addEventListener('click', function () {
        // Lorsque le bouton est cliqué, la valeur 'true' est stockée dans le stockage local sous la clé 'cookie-consent', indiquant que l'utilisateur a accepté.
        localStorage.setItem('cookie-consent', 'true');
        // La bannière de consentement est ensuite masquée.
        consentBanner.style.display = 'none';
    });

    // Ajoute un écouteur d'événement au bouton "Refuser".
    rejectButton.addEventListener('click', function () {
        // Lorsque le bouton est cliqué, la valeur 'false' est stockée dans le stockage local sous la clé 'cookie-consent', indiquant que l'utilisateur a refusé.
        localStorage.setItem('cookie-consent', 'false');
        // La bannière de consentement est ensuite masquée.
        consentBanner.style.display = 'none';
    });
});
