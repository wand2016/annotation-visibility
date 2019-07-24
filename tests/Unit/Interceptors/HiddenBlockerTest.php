<?php

declare(strict_types=1);

namespace Tests\Unit\Interceptors;

use PHPUnit\Framework\TestCase;

use WandTa\Interceptors\HiddenBlocker;

class VisitorTest extends TestCase
{
    /** @var HiddenBlocker */
    private $sut;

    public function setUp():void
    {
        parent::setUp();

        $this->sut = new HiddenBlocker();
    }

    /** @test */
    public function sample()
    {
        $this->assertTrue(true);
    }
}
