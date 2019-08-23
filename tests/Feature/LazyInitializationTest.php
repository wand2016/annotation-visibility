<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use Tests\Feature\Sample\LazyInitialization\Mapper;
use WandTa\Exceptions\AccessViolationException;

/**
 * 遅延初期化パターンのテスト
 */
class LazyInitializationTest extends TestCase
{
    /** @var Mapper */
    private $mapper;

    public function setUp(): void
    {
        $this->mapper = new Mapper();
    }

    /** @test */
    public function Mapperの中でsetterを叩ける()
    {
        $model = $this->mapper->find(1);
        $model->load(); // setter is called
        $this->assertTrue(true);
    }

    /** @test */
    public function クライアントコードからsetterを叩くとエラー()
    {
        $this->expectException(AccessViolationException::class);
        $model = $this->mapper->find(1);
        $model->setName('hoge');
    }
}
