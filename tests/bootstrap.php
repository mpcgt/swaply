<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

// Charge .env uniquement s'il est lisible
$envFile = dirname(__DIR__).'/.env';
if (method_exists(Dotenv::class, 'bootEnv') && is_readable($envFile)) {
    (new Dotenv())->bootEnv($envFile);
}
