<?php

declare(strict_types=1);

namespace WyriHaximus\React\Mutex\KeyPrefix;

use React\Promise\PromiseInterface;
use WyriHaximus\React\Mutex\Contracts\LockInterface;
use WyriHaximus\React\Mutex\Contracts\MutexInterface;

use function Safe\substr;
use function strlen;

final class Mutex implements MutexInterface
{
    private string $prefix;
    private int $prefixLength;
    private MutexInterface $mutex;

    public function __construct(string $prefix, MutexInterface $mutex)
    {
        $this->prefix       = $prefix;
        $this->prefixLength = strlen($prefix);
        $this->mutex        = $mutex;
    }

    public function acquire(string $key, float $ttl): PromiseInterface
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         */
        return $this->mutex->acquire($this->prefix . $key, $ttl)->then(
            fn (?LockInterface $lock): ?LockInterface => $lock instanceof LockInterface ? new Lock(substr($lock->key(), $this->prefixLength), $lock->rng()) : $lock
        );
    }

    public function spin(string $key, float $ttl, int $attempts, float $interval): PromiseInterface
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         */
        return $this->mutex->spin($this->prefix . $key, $ttl, $attempts, $interval)->then(
            fn (?LockInterface $lock): ?LockInterface => $lock instanceof LockInterface ? new Lock(substr($lock->key(), $this->prefixLength), $lock->rng()) : $lock
        );
    }

    public function release(LockInterface $lock): PromiseInterface
    {
        /**
         * @psalm-suppress TooManyTemplateParams
         */
        return $this->mutex->release(new Lock($this->prefix . $lock->key(), $lock->rng()));
    }
}
