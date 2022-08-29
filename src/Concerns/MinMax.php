<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait MinMax
{
    /** @var int */
    protected int $min = 0;

    /** @var int */
    protected int $max = 0;

    /**
     * @param int $value
     * @return $this
     */
    public function min(int $value)
    {
        $this->min = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function max(int $value)
    {
        $this->max = $value;

        return $this;
    }
}