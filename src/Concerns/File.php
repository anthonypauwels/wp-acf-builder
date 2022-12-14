<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait File
{
    /** @var int */
    protected int $minSize = 0;

    /** @var int */
    protected int $maxSize = 0;

    /** @var array */
    protected array $mimeTypes = [];

    /**
     * @param ...$mime_types
     * @return AbstractField
     */
    public function mimeTypes(...$mime_types): AbstractField
    {
        $this->mimeTypes = $mime_types;

        return $this;
    }

    /**
     * @param int $value
     * @param string $unit
     * @return AbstractField
     */
    public function minSize(int $value, string $unit = 'MB'): AbstractField
    {
        $this->minSize = $value . trim( $unit );

        return $this;
    }

    /**
     * @param int $value
     * @param string $unit
     * @return AbstractField
     */
    public function maxSize(int $value, string $unit = 'MB'): AbstractField
    {
        $this->maxSize = $value . trim( $unit );

        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     * @param string $unit
     * @return AbstractField
     */
    public function size(int $min, int $max = 0, string $unit = 'MB'): AbstractField
    {
        if ( is_string( $max ) ) {
            $unit = $max;
            $max = 0;
        }

        return $this->minSize( $min, $unit )->maxSize( $max, $unit );
    }
}