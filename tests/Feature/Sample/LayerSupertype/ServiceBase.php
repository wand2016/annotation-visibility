<?php

declare(strict_types=1);

namespace Tests\Feature\Sample\LayerSupertype;

abstract class ServiceBase
{
    /** @var DomainModel */
    private $model;

    public function __construct(DomainModel $model)
    {
        $this->model = $model;
    }

    public function someOperation(): void
    {
        $this->model->someOperation();
    }
}
