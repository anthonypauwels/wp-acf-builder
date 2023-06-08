<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait MaxLength
{
    /** @var int */
    protected int $maxLength = 0;

    /**
     * @param int $limit
     * @return $this
     */
    public function maxLength(int $limit): self
    {
        $this->maxLength = $limit;

        return $this;
    }
}