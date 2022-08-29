<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Required
{
    /** @var int */
    protected int $required = 0;

    /**
     * @param bool $value
     * @return AbstractField
     */
    public function required(bool $value = true): AbstractField
    {
        $this->required = $value;

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function notRequired(): AbstractField
    {
        return $this->required( false );
    }
}