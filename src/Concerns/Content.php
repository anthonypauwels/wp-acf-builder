<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Content
{
    /** @var string */
    protected string $append = '';

    /** @var string */
    protected string $prepend = '';

    /**
     * @param string $content
     * @return $this
     */
    public function append(string $content): self
    {
        $this->append = $content;

        return $this;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function prepend(string $content): self
    {
        $this->prepend = $content;

        return $this;
    }
}