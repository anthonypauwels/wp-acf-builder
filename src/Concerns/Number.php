<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\RangeField;
use Anthonypauwels\WpAcfBuilder\Fields\NumberField;

/**
 * Class Number
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Number
{
    /** @var int */
    protected int $min = 0;

    /** @var int */
    protected int $max = 0;

    /** @var int */
    protected int $step = 0;

    /**
     * @param int $value
     * @return NumberField|Number|RangeField
     */
    public function min(int $value): self
    {
        $this->min = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return NumberField|Number|RangeField
     */
    public function max(int $value): self
    {
        $this->max = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return NumberField|Number|RangeField
     */
    public function step(int $value): self
    {
        $this->step = $value;

        return $this;
    }
}