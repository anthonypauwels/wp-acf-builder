<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait DefaultValue
{
    /** @var string */
    protected string $default = '';

    /**
     * @param string $default
     * @return AbstractField
     */
    public function default(string $default): AbstractField
    {
        $this->default = $default;

        return $this;
    }
}