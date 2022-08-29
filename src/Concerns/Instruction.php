<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Instruction
{
    /** @var string */
    protected string $instructions = '';

    /**
     * @param string $instructions
     * @return AbstractField
     */
    public function instructions(string $instructions): AbstractField
    {
        $this->instructions = $instructions;

        return $this;
    }
}