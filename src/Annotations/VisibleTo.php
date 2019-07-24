<?php

declare(strict_types=1);

namespace WandTa\Annotations;

/**
 * VisibleTo
 *
 * @Annotation
 * @Target("METHOD")
 */
final class VisibleTo
{
    /** @var string */
    private $className = '';

    public function __construct(array $data)
    {
        $this->className = $data['value'] ?? '';
    }

    /**
     * @todo 継承とかケアする
     */
    public function visibleTo(string $classNameTested)
    {
        return $this->className === $classNameTested;
    }
}
