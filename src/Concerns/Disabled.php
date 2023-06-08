<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Disabled
{
    /** @var bool */
    protected bool $disabled = false;

    /**
     * @param bool $value
     * @return $this
     */
    public function disable(bool $value = true): self
    {
        $this->disabled = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function enable(): self
    {
        return $this->disable( false );
    }
}