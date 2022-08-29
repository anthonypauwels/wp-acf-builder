<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Nullable
{
    /** @var bool */
    protected bool $nullable = false;

    /**
     * @param bool $value
     * @return AbstractField
     */
    public function nullable(bool $value = true): AbstractField
    {
        $this->nullable = $value;

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function notNullable(): AbstractField
    {
        return $this->nullable( false );
    }
}