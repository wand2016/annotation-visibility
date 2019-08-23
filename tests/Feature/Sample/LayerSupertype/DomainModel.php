<?php

declare(strict_types=1);

namespace Tests\Feature\Sample\LayerSupertype;

use WandTa\Annotations\VisibleTo;

class DomainModel
{

    /**
     * @VisibleTo("Tests\Feature\Sample\LayerSupertype\ServiceBase")
     */
    public function someOperation(): void
    { }
}
