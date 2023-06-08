<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Nullable
{
    /** @var bool */
    protected bool $nullable = false;

    /**
     * @param bool $value
     * @return $this
     */
    public function nullable(bool $value = true): self
    {
        $this->nullable = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function notNullable(): self
    {
        return $this->nullable( false );
    }
}