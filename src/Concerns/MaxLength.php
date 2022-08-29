<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait MaxLength
{
    /** @var int */
    protected int $maxLength = 0;

    /**
     * @param int $limit
     * @return AbstractField
     */
    public function maxLength(int $limit): AbstractField
    {
        $this->maxLength = $limit;

        return $this;
    }
}