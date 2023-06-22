<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Flexible;
use Anthonypauwels\WpAcfBuilder\Repeater;

/**
 * Trait Button
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Button
{
    /** @var string */
    protected string $button = 'Add row';

    /**
     * Define the label of a button
     *
     * @param string $label
     * @return Flexible|Button|Repeater
     */
    public function button(string $label):self
    {
        $this->button = $label;

        return $this;
    }
}