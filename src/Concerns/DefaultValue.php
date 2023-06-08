<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait DefaultValue
{
    /** @var string */
    protected string $default = '';

    /**
     * @param string $default
     * @return $this
     */
    public function default(string $default): self
    {
        $this->default = $default;

        return $this;
    }
}