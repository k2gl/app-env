<?php

declare(strict_types=1);

namespace K2gl\Component\AppEnv\Tests\Services\AppEnv;

use K2gl\Component\AppEnv\Services\AppEnv;
use K2gl\Component\AppEnv\Tests\AppEnvironmentExample;
use PHPUnit\Framework\TestCase;

use function K2gl\PHPUnitFluentAssertions\fact;

/** @covers \K2gl\Component\AppEnv\Services\AppEnv::is() */
final class TestAppEnvIs extends TestCase
{
    public function testAppEnvIs(): void
    {
        // arrange
        $appEnv = new AppEnv('dev');

        // act
        $result = [
            1 => $appEnv->is('dev'),
            2 => $appEnv->is('DEV'),
            3 => $appEnv->is(AppEnvironmentExample::PROD),
            4 => $appEnv->is(AppEnvironmentExample::PROD->value),
            5 => $appEnv->is(AppEnvironmentExample::DEV),
            6 => $appEnv->is(AppEnvironmentExample::DEV->value),
        ];

        // assert
        fact($result[1])->true();
        fact($result[2])->false();
        fact($result[3])->false();
        fact($result[4])->false();
        fact($result[5])->true();
        fact($result[6])->true();
    }
}
