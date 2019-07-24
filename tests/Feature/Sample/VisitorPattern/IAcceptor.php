<?php

declare(strict_types=1);

namespace Tests\Feature\Sample\VisitorPattern;

interface IAcceptor
{
    public function accept(IVisitor $visitor);
}
