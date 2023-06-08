<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Required
{
    /** @var int */
    protected int $required = 0;

    /**
     * @param bool $value
     * @return $this
     */
    public function required(bool $value = true): self
    {
        $this->required = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function notRequired(): self
    {
        return $this->required( false );
    }
}