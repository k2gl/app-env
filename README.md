# PHP AppEnv service

[![CI](https://img.shields.io/github/actions/workflow/status/k2gl/app-env/ci.yml?branch=main&label=CI&logo=github)](https://github.com/k2gl/app-env/actions/workflows/ci.yml)
[![Latest Stable Version](https://img.shields.io/packagist/v/k2gl/app-env?logo=packagist&logoColor=white)](https://packagist.org/packages/k2gl/app-env)
[![Total Downloads](https://img.shields.io/packagist/dt/k2gl/app-env?logo=packagist&logoColor=white)](https://packagist.org/packages/k2gl/app-env)
[![PHPStan Level](https://img.shields.io/badge/PHPStan-level%209-2a5ea7?logo=php&logoColor=white)](https://phpstan.org)
[![License](https://img.shields.io/packagist/l/k2gl/app-env?color=yellowgreen)](https://packagist.org/packages/k2gl/app-env)

Run code conditionally on the current application environment (prod, dev, test).

## Installation

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

```
composer require k2gl/app-env
```

## Usage:

```php

enum AppEnvironment: string
{
    case DEV = 'dev';
    case TEST = 'test';
    case STAGE = 'stage';
    case PROD = 'prod';
}

use K2gl\Component\AppEnv\Services\AppEnv;

$appEnv = new AppEnv('test');

$appEnv->is('test'); // true
$appEnv->is(AppEnvironment::TEST); // true

$appEnv->not(AppEnvironment::TEST); // false
$appEnv->not('miss'); // true

$appEnv->in(['miss', 'kiss']); // false
$appEnv->in(['miss', 'test', 'kiss']); // true

$appEnv->notIn(['miss', 'kiss']); // true
$appEnv->notIn(['miss', 'test', 'kiss']); // false
```

## Configuration as Symfony service

Makes AppEnv available to be used as services in **services.yaml**

```
services:
    K2gl\Component\AppEnv\Services\AppEnv:
        arguments: ['%kernel.environment%']
```

## Usage example:

```php
use K2gl\Component\AppEnv\Services\AppEnv;

class UserLoginProcessor
{
    public function __construct(
        private readonly AppEnv $appEnv,
    ) {
    }
    
    protected function getAuthenticationFailureResponse(AuthenticationException $exception): JsonResponse
    {
        $responseData = [ 'message' => 'Bad credentials' ];

        if ($this->appEnv->not(AppEnvironment::PROD)) {             
            $responseData[ 'extended_message' ] = $exception->getMessage();
        }

        return new JsonResponse( data: $responseData, status: Response::HTTP_UNAUTHORIZED );
    }    
}
```

## Pull requests are always welcome
[Collaborate with pull requests](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)

