<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Placeholder
{
    /** @var string */
    protected string $placeholder = '';

    /**
     * @param string $value
     * @return $this
     */
    public function placeholder(string $value): self
    {
        $this->placeholder = $value;

        return $this;
    }
}