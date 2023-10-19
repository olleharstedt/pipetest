<?php

use PHPUnit\Framework\TestCase;
use PipeTest\Factory;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../src/functions.php';

/**
 * XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-text
 * XDEBUG_MODE=coverage php ./vendor/bin/phpunit --coverage-clover cov.xml
 */
class PipeTest extends TestCase
{
    /**
     * @covers pipe
     */
    public function testPipe()
    {
        pipe();
        foo();
        $this->assertTrue(true);
    }
}
