<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Image
{
    /** @var int */
    protected int $minWidth = 0;

    /** @var int */
    protected int $minHeight = 0;

    /** @var int */
    protected int $maxWidth = 0;

    /** @var int */
    protected int $maxHeight = 0;

    /**
     * @param int $value
     * @return AbstractField
     */
    public function minWidth(int $value): AbstractField
    {
        $this->minWidth = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return AbstractField
     */
    public function maxWidth(int $value): AbstractField
    {
        $this->maxWidth = $value;

        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     * @return AbstractField
     */
    public function width(int $min, int $max = 0): AbstractField
    {
        return $this->minWidth( $min )->maxWidth( $max );
    }

    /**
     * @param int $value
     * @return AbstractField
     */
    public function minHeight(int $value): AbstractField
    {
        $this->minHeight = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return AbstractField
     */
    public function maxHeight(int $value): AbstractField
    {
        $this->maxHeight = $value;

        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     * @return AbstractField
     */
    public function height(int $min, int $max = 0): AbstractField
    {
        return $this->minHeight( $min )->maxHeight( $max );
    }
}