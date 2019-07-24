<?php

declare(strict_types=1);

namespace Tests\Feature\Sample\VisitorPattern;

use WandTa\Annotations\VisibleTo;

class HelloVisitor implements IVisitor
{
    /** @var string */
    private $greet;

    /**
     * @VisibleTo("Tests\Feature\Sample\VisitorPattern\AcceptorA")
     * @param AcceptorA $acceptorA
     */
    public function visitA(AcceptorA $acceptorA)
    {
        $this->greet = 'hello A';
    }

    /**
     * @VisibleTo("Tests\Feature\Sample\VisitorPattern\AcceptorB")
     * @param AcceptorB $acceptorB
     */
    public function visitB(AcceptorB $acceptorB)
    {
        $this->greet = 'hello B';
    }

    /**
     * get greeting message
     * @return string
     */
    public function getGreet(): string
    {
        return $this->greet;
    }
}
