<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait ReadOnly
{
    /** @var bool */
    protected bool $readOnly = false;

    /**
     * @param bool $value
     * @return $this
     */
    public function readOnly(bool $value = true): self
    {
        $this->readOnly = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function notReadOnly(): self
    {
        return $this->readOnly( false );
    }
}