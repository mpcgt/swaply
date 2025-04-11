<?php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;

if (getenv('APP_ENV') === 'prod') {
    $_SERVER['APP_ENV'] = 'prod';
    $_SERVER['APP_DEBUG'] = '0';
}

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};