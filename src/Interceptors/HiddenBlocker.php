<?php

declare(strict_types=1);

namespace WandTa\Interceptors;

use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;

use WandTa\Annotations\VisibleTo;
use WandTa\Exceptions\AccessViolationException;

/**
 * 不可視ブロッカー
 * 許可リスト外からアクセスされたら例外を投げる
 */
class HiddenBlocker implements MethodInterceptor
{
    public function lookupCaller(
        string $className,
        string $methodName,
        array $backTrace
    ): string {
        $caller = '';
        foreach ($backTrace as $index => $traceLine) {
            if (
                // Ray.AOPによりbindされると、スタックトレース上のクラス名は_[a-z][A-Z]+がつく
                strpos($traceLine['class'], "${className}_") === 0
                // メソッド名はそのまま
                && $methodName === $traceLine['function']
            ) {
                $caller = $backTrace[$index + 1]['class'];
                break;
            }
        }

        return $caller;
    }

    public function invoke(MethodInvocation $invocation)
    {
        // interceptする対象のメソッドの情報を取得
        $className = $invocation->getMethod()->getDeclaringClass()->getName();
        $methodName = $invocation->getMethod()->getName();

        // コールスタックを遡りcallerを得る
        $backTrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        $caller = $this->lookupCaller(
            $className,
            $methodName,
            $backTrace
        );

        /** @var VisibleTo[] */
        $visibleToAnnotations = array_filter(
            $invocation->getMethod()->getAnnotations(),
            function ($annotationObject) {
                return $annotationObject instanceof VisibleTo;
            }
        );

        foreach ($visibleToAnnotations as $visibleToAnnotation) {
            // 呼び出し許可リストに入っていれば通常の呼び出し
            if ($visibleToAnnotation->visibleTo($caller)) {
                $invocation->proceed();
                return;
            }
        }

        // 呼び出し許可リストに入っていなければ例外送出
        throw new AccessViolationException(
            $invocation->getMethod()->getName() . " can't be called by ${caller}"
        );
    }
}
