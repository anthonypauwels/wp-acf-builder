<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Instruction
{
    /** @var string */
    protected string $instructions = '';

    /**
     * @param string $instructions
     * @return $this
     */
    public function instructions(string $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }
}