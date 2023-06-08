<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Multiple
{
    /** @var bool */
    protected bool $multiple = false;

    /**
     * @param bool $value
     * @return $this
     */
    public function multiple(bool $value = true): self
    {
        $this->multiple = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function notMultiple(): self
    {
        return $this->multiple( false );
    }
}