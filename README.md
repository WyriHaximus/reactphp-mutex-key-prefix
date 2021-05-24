# ReactPHP Mutex Key Prefix

[![Continuous Integration](https://github.com/WyriHaximus/reactphp-mutex-key-prefix/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/WyriHaximus/reactphp-mutex-key-prefix/actions/workflows/ci.yml)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/react-mutex-key-prefix/v/stable.png)](https://packagist.org/packages/WyriHaximus/react-mutex-key-prefix)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/react-mutex-key-prefix/downloads.png)](https://packagist.org/packages/WyriHaximus/react-mutex-key-prefix)
[![License](https://poser.pugx.org/WyriHaximus/react-mutex-key-prefix/license.png)](https://packagist.org/packages/WyriHaximus/react-mutex-key-prefix)

# Installation

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require wyrihaximus/react-mutex-key-prefix
```

# Usage

```php
<?php

use WyriHaximus\React\Mutex\KeyPrefix\Mutex;
use WyriHaximus\React\Mutex\Memory;

$upstreamMutex = new Memory(); // Using Memory as example here, but can also be Redis
$mutex = new Mutex('prefix:', $upstreamMutex); // All keys are transparently prefixed with `prefix:`

$lock = $mutex->acquire('key', 1.23); // In the mutex store, the key is `prefix:key`, but in the lock we return it's just `key`, always pass the lock back to the same mutex you got it from
```

# License

The MIT License (MIT)

Copyright (c) 2021 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
