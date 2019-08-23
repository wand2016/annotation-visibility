<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use Tests\Feature\Sample\LayerSupertype\ServiceBase;
use Tests\Feature\Sample\LayerSupertype\ConcreteService;
use Tests\Feature\Sample\LayerSupertype\DomainModel;
use WandTa\Container;
use WandTa\Exceptions\AccessViolationException;

class LayerSupertypeTest extends TestCase
{
    /** @var Container */
    private $container;

    /** @var ServiceBase */
    private $service;

    /** @var DomainModel */
    private $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->container = new Container;
        $this->model = $this->container->make(DomainModel::class);
        $this->service = new ConcreteService($this->model);
    }

    /** @test */
    public function Service以外のクラスからDomainModelのsomeOperationを実行できない()
    {
        $this->expectException(AccessViolationException::class);
        $this->model->someOperation();
    }

    /** @test */
    public function ServiceBase派生クラスからDomainModelのsomeOperationを実行できる()
    {
        $this->service->someOperation(); // calls model's someOperation
        $this->assertTrue(true);
    }
}
