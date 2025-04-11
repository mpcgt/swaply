<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

// Charger les variables d'environnement si elles sont définies
if (file_exists(dirname(__DIR__).'/.env')) {
    (new Symfony\Component\Dotenv\Dotenv())->load(dirname(__DIR__).'/.env');
}

// Si les variables sont déjà définies dans l'environnement (via Railway), elles seront utilisées.
return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};