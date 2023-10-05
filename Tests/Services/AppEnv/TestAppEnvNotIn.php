<?php

declare(strict_types=1);

namespace K2gl\Component\AppEnv\Tests\Services\AppEnv;

use K2gl\Component\AppEnv\Services\AppEnv;
use K2gl\Component\AppEnv\Tests\AppEnvironmentExample;
use PHPUnit\Framework\TestCase;

use function K2gl\PHPUnitFluentAssertions\fact;

/** @covers \K2gl\Component\AppEnv\Services\AppEnv::notIn() */
final class TestAppEnvNotIn extends TestCase
{
    public function testAppEnvNot(): void
    {
        // arrange
        $appEnv = new AppEnv('stage');

        // act
        $result = [
            1 => $appEnv->notIn(['miss', 'stage', 'kiss']),
            2 => $appEnv->notIn(['miss', 'kiss']),
            3 => $appEnv->notIn([
                AppEnvironmentExample::DEV,
                AppEnvironmentExample::STAGE,
                AppEnvironmentExample::PROD,
            ]),
            4 => $appEnv->notIn([AppEnvironmentExample::DEV, AppEnvironmentExample::PROD]),
        ];

        // assert
        fact($result[1])->false();
        fact($result[2])->true();
        fact($result[3])->false();
        fact($result[4])->true();
    }
}
