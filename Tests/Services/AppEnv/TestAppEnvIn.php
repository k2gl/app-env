<?php

declare(strict_types=1);

namespace K2gl\Component\AppEnv\Tests\Services\AppEnv;

use K2gl\Component\AppEnv\Services\AppEnv;
use K2gl\Component\AppEnv\Tests\AppEnvironmentExample;

use function K2gl\PHPUnitFluentAssertions\fact;

use PHPUnit\Framework\TestCase;

final class TestAppEnvIn extends TestCase
{
    public function testAppEnvNot(): void
    {
        // arrange
        $appEnv = new AppEnv('prod');

        // act
        $result = [
            1 => $appEnv->in(['miss', 'kiss']),
            2 => $appEnv->in(['miss', 'prod', 'kiss']),
            3 => $appEnv->in([AppEnvironmentExample::DEV, AppEnvironmentExample::STAGE]),
            4 => $appEnv->in([
                AppEnvironmentExample::DEV,
                AppEnvironmentExample::PROD,
                AppEnvironmentExample::STAGE,
            ]),
        ];

        // assert
        fact($result[1])->false();
        fact($result[2])->true();
        fact($result[3])->false();
        fact($result[4])->true();
    }
}
