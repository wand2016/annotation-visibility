<?php

declare(strict_types=1);

namespace Tests\Feature\Sample\VisitorPattern;

class AcceptorA implements IAcceptor
{
    public function accept(IVisitor $visitor) {
        $visitor->visitA($this);
    }
}
