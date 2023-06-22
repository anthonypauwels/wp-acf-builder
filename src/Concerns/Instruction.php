<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\AbstractGroup;
use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

/**
 * Class Instruction
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Instruction
{
    /** @var string */
    protected string $instructions = '';

    /**
     * @param string $instructions
     * @return Instruction|AbstractGroup|AbstractField
     */
    public function instructions(string $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }
}