<?php

declare(strict_types=1);

namespace K2gl\Component\AppEnv\Tests;

enum AppEnvironmentExample: string
{
    case DEV = 'dev';
    case TEST = 'test';
    case STAGE = 'stage';
    case PROD = 'prod';
}