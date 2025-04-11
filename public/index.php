<?php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

$appEnv = $_ENV['APP_ENV'] ?? getenv('APP_ENV') ?? 'dev';

// Charger .env **uniquement** si on n'est pas en prod
if ($appEnv !== 'prod' && file_exists(dirname(__DIR__).'/.env')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

return function (array $context) use ($appEnv) {
    return new Kernel($appEnv, (bool) ($context['APP_DEBUG'] ?? false));
};