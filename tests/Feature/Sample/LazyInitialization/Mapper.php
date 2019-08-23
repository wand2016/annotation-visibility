<?php

declare(strict_types=1);

namespace Tests\Feature\Sample\LazyInitialization;

use WandTa\Container;

class Mapper
{
    /** @var Container */
    private $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @param int $id
     * @return DomainModel
     */
    public function find(int $id): DomainModel
    {
        return $this->container->make(
            DomainModel::class,
            [
                new Mapper(),
                $id
            ]
        );
    }

    /**
     * データ読み込み
     * @param DomainModel $model
     * @return void
     */
    public function load(DomainModel $model): void
    {
        $model->setName('hoge');
    }
}
