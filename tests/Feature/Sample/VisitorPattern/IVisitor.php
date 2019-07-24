<?php

declare(strict_types=1);

namespace Tests\Feature\Sample\VisitorPattern;

interface IVisitor
{
    public function visitA(AcceptorA $acceptorA);
    public function visitB(AcceptorB $acceptorB);
}
