<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

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
     * @return AbstractField
     */
    public function min(int $value): AbstractField
    {
        $this->min = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return AbstractField
     */
    public function max(int $value): AbstractField
    {
        $this->max = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return AbstractField
     */
    public function step(int $value): AbstractField
    {
        $this->step = $value;

        return $this;
    }
}