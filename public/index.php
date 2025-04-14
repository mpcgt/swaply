<?php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

$envFile = dirname(__DIR__).'/.env';
if (is_readable($envFile)) {
    (new Dotenv())->bootEnv($envFile);
}

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
