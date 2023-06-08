<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

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
     * @return $this
     */
    public function min(int $value): self
    {
        $this->min = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function max(int $value): self
    {
        $this->max = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function step(int $value): self
    {
        $this->step = $value;

        return $this;
    }
}