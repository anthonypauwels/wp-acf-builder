<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait ReadOnly
{
    /** @var bool */
    protected bool $readOnly = false;

    /**
     * @param bool $value
     * @return AbstractField
     */
    public function readOnly(bool $value = true): AbstractField
    {
        $this->readOnly = $value;

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function notReadOnly(): AbstractField
    {
        return $this->readOnly( false );
    }
}