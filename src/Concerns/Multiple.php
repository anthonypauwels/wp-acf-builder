<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Multiple
{
    /** @var bool */
    protected bool $multiple = false;

    /**
     * @param bool $value
     * @return AbstractField
     */
    public function multiple(bool $value = true): AbstractField
    {
        $this->multiple = $value;

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function notMultiple(): AbstractField
    {
        return $this->multiple( false );
    }
}