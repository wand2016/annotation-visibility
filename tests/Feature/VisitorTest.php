<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

use Tests\Feature\Sample\VisitorPattern\AcceptorA;
use Tests\Feature\Sample\VisitorPattern\AcceptorB;
use Tests\Feature\Sample\VisitorPattern\HelloVisitor;
use WandTa\Container;
use WandTa\Exceptions\AccessViolationException;

class VisitorTest extends TestCase
{
    /** @var HelloVisitor */
    private $helloVisitor;

    /** @var AcceptorA */
    private $acceptorA;

    /** @var AcceptorB */
    private $acceptorB;

    /** @var Container */
    private $container;

    /**
     * @todo Ray AOP
     */
    public function setUp():void
    {
        parent::setUp();

        $this->container = new Container;
        $this->helloVisitor = $this->container->make(HelloVisitor::class);
        $this->acceptorA = new AcceptorA();
        $this->acceptorB = new AcceptorB();
    }


    /** @test */
    public function AcceptorAからvisitAしてhello_Aを得る()
    {
        $this->acceptorA->accept($this->helloVisitor);
        $this->assertSame(
            'hello A',
            $this->helloVisitor->getGreet()
        );
    }

    /** @test */
    public function AcceptorBからvisitBしてhello_Bを得る()
    {
        $this->acceptorB->accept($this->helloVisitor);
        $this->assertSame(
            'hello B',
            $this->helloVisitor->getGreet()
        );
    }

    /**
     * @test
     */
    public function クライアントコードからvisitAすると例外()
    {
        $this->expectException(AccessViolationException::class);
        $this->helloVisitor->visitA($this->acceptorA);
        $this->assertTrue(false);
    }

    /**
     * @test
     */
    public function クライアントコードからvisitBすると例外()
    {
        $this->expectException(AccessViolationException::class);
        $this->helloVisitor->visitB($this->acceptorB);
        $this->assertTrue(false);
    }
}
