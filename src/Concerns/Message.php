<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Message
{
    /** @var string */
    protected string $message = '';

    /**
     * @param string $content
     * @return $this
     */
    public function message(string $content): self
    {
        $this->message = $content;

        return $this;
    }
}