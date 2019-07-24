# PHP Annotation Visibility (TBD)

- friendshipやpackage privateをエミュレートするためのライブラリ

# 動機

- デザインパターンの中には、特定のクラスにのみメソッドを公開したいケースがある
    - Visitor
    - Iterator
    - Memento
    - etc.
- しかし、PHPの言語仕様としては、アクセス制御は下記の3種類のみ
    - public
    - protected
    - private
- 下記のようなアクセス制御は提供されていない
    - 特定のクラスにのみメソッドを公開する(≒friend)
    - 同一パッケージ内にのみメソッドを公開する(package private)
- アノテーションでこれらをエミュレートすることを目的とする
- 上記のアクセス制御は実行時エラーを出すためのものではないため、本番環境での使用は想定しない
- CI環境等の自動テストで不正な呼び出しを検出することを目的とする


# サンプル

```php
<?php

declare(strict_types=1);

namespace Tests\Feature\Sample\VisitorPattern;

use WandTa\Annotations\VisibleTo;

class HelloVisitor implements IVisitor
{
    /** @var string */
    private $greet;

    /**
     * @VisibleTo("Tests\Feature\Sample\VisitorPattern\AcceptorA")
     * @param AcceptorA $acceptorA
     */
    public function visitA(AcceptorA $acceptorA)
    {
        $this->greet = 'hello A';
    }

    /**
     * @VisibleTo("Tests\Feature\Sample\VisitorPattern\AcceptorB")
     * @param AcceptorB $acceptorB
     */
    public function visitB(AcceptorB $acceptorB)
    {
        $this->greet = 'hello B';
    }

    /**
     * get greeting message
     * @return string
     */
    public function getGreet(): string
    {
        return $this->greet;
    }
}
```

- `VisitA`メソッドは`Tests\Feature\Sample\VisitorPattern\AcceptorA`クラスからのみ呼び出し可能
- `VisitB`メソッドは`Tests\Feature\Sample\VisitorPattern\AcceptorB`クラスからのみ呼び出し可能
- `getGreet`メソッドは任意のクラスから呼び出し可能(通常のpublic)
