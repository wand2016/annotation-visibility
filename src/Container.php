<?php

declare(strict_types=1);

namespace WandTa;

use Ray\Aop\Matcher;
use Ray\Aop\Pointcut;
use Ray\Aop\Bind;
use Ray\Aop\Compiler;

use WandTa\Annotations\VisibleTo;
use WandTa\Interceptors\HiddenBlocker;

class Container
{
    const STORAGE = __DIR__ . '/storage';
    /**
     * instantiate instance with interception
     * @param string $clasName  インスタンシエート対象クラス
     * @param array  $arguments インスタンシエート引数
     * @return mixed オブジェクト
     */
    public function make(
        string $className,
        array $arguments = []
    ) {
        $pointcut = new Pointcut(
            (new Matcher)->any(),
            (new Matcher)->annotatedWith(VisibleTo::class),
            [new HiddenBlocker]
        );
        $bind = (new Bind)->bind($className, [$pointcut]);

        return (new Compiler(self::STORAGE))->newInstance($className, $arguments, $bind);
    }
}
