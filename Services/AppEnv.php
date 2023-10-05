<?php

declare(strict_types=1);

namespace K2gl\Component\AppEnv\Services;

use BackedEnum;

class AppEnv
{
    public function __construct(
        protected readonly string $env
    ) {
    }

    public function is(BackedEnum|string $env): bool
    {
        if ($env instanceof BackedEnum) {
            return $this->env === $env->value;
        }

        return $this->env === $env;
    }

    public function not(BackedEnum|string $env): bool
    {
        return !$this->is($env);
    }

    /**
     * @param BackedEnum[]|string[] $envs
     */
    public function in(array $envs): bool
    {
        foreach ($envs as $env) {
            if ($this->is($env)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param BackedEnum[]|string[] $envs
     */
    public function notIn(array $envs): bool
    {
        return !$this->in($envs);
    }
}
