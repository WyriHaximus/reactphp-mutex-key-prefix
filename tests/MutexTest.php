<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\React\Mutex\KeyPrefix;

use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use WyriHaximus\React\Mutex\AbstractMutexTestCase;
use WyriHaximus\React\Mutex\Contracts\MutexInterface;
use WyriHaximus\React\Mutex\KeyPrefix\Mutex;
use WyriHaximus\React\Mutex\Memory;

final class MutexTest extends AbstractMutexTestCase
{
    public function provideMutex(LoopInterface $loop): MutexInterface
    {
        return new Mutex('prefix:', new Memory());
    }

    /**
     * @test
     */
    public function prefixIsStrippedFromLockObject(): void
    {
        $lock = $this->await($this->provideMutex(Factory::create())->acquire('key', 1.23));

        self::assertSame('key', $lock->key());
    }
}
