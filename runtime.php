<?php

use Symfony\Component\Runtime\SymfonyRuntime;

return new class extends SymfonyRuntime {
    protected function getEnv(array $options): array
    {
        return [
            'APP_ENV' => $_ENV['APP_ENV'] ?? getenv('APP_ENV') ?? 'prod',
            'APP_DEBUG' => $_ENV['APP_DEBUG'] ?? getenv('APP_DEBUG') ?? false,
        ];
    }
};
