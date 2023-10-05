<?php

declare(strict_types=1);

namespace K2gl\Component\AppEnv\Tests\AppEnv;

use K2gl\Component\AppEnv\AppEnv;
use K2gl\Component\AppEnv\Tests\Examples\AppEnvironmentExample;
use PHPUnit\Framework\TestCase;

use function K2gl\PHPUnitFluentAssertions\fact;

/** @covers \K2gl\Component\AppEnv\AppEnv::not() */
final class AppEnvNotTest extends TestCase
{
    public function testAppEnvNot(): void
    {
        // arrange
        $appEnv = new AppEnv('prod');

        // act
        $result = [
            1 => $appEnv->not('dev'),
            2 => $appEnv->not('DEV'),
            3 => $appEnv->not(AppEnvironmentExample::PROD),
            4 => $appEnv->not(AppEnvironmentExample::PROD->value),
            5 => $appEnv->not('prod'),
            6 => $appEnv->not(AppEnvironmentExample::DEV),
            7 => $appEnv->not(AppEnvironmentExample::DEV->value),
        ];

        // assert
        fact($result[1])->true();
        fact($result[2])->true();
        fact($result[3])->false();
        fact($result[4])->false();
        fact($result[5])->false();
        fact($result[6])->true();
        fact($result[7])->true();
    }
}
