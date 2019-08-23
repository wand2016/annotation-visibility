<?php

declare(strict_types=1);

namespace Tests\Feature\Sample\LazyInitialization;

use WandTa\Annotations\VisibleTo;

class DomainModel
{
    /** @var Mapper */
    private $mapper;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    public function __construct(
        Mapper $mapper,
        int $id
    ) {
        $this->mapper = $mapper;
        $this->id = $id;
    }

    /**
     * @VisibleTo("Tests\Feature\Sample\LazyInitialization\Mapper")
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * 遅延読み込み
     * @return void
     */
    public function load(): void
    {
        $this->mapper->load($this);
    }
}
