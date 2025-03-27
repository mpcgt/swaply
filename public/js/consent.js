document.addEventListener('DOMContentLoaded', function () {
    const consentBanner = document.getElementById('consent-banner');
    const acceptButton = document.getElementById('accept-consent');
    const rejectButton = document.getElementById('reject-consent');

    // Vérifier si l'utilisateur a déjà consenti ou refusé
    if (!localStorage.getItem('cookie-consent')) {
        consentBanner.style.display = 'block';
    }

    acceptButton.addEventListener('click', function () {
        localStorage.setItem('cookie-consent', 'true');
        consentBanner.style.display = 'none';
    });

    rejectButton.addEventListener('click', function () {
        localStorage.setItem('cookie-consent', 'false');
        consentBanner.style.display = 'none';
    });
});
