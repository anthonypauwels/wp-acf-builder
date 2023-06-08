<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Choices
{
    /** @var array */
    protected array $choices = [];

    /**
     * @param array $choices
     * @return $this
     */
    public function choices(array $choices): self
    {
        $this->choices = $choices;

        return $this;
    }
}