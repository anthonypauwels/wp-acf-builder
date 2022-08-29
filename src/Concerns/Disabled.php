<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Disabled
{
    /** @var bool */
    protected bool $disabled = false;

    /**
     * @param bool $value
     * @return AbstractField
     */
    public function disable(bool $value = true): AbstractField
    {
        $this->disabled = $value;

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function enable(): AbstractField
    {
        return $this->disable( false );
    }
}