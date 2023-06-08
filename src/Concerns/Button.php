<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Button
{
    /** @var string */
    protected string $button = 'Add row';

    /**
     * Define the label of a button
     *
     * @param string $label
     * @return $this
     */
    public function button(string $label):self
    {
        $this->button = $label;

        return $this;
    }
}