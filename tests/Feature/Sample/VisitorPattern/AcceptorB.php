<?php

declare(strict_types=1);

namespace Tests\Feature\Sample\VisitorPattern;

class AcceptorB implements IAcceptor
{
    public function accept(IVisitor $visitor) {
        $visitor->visitB($this);
    }
}
