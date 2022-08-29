<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Placeholder
{
    /** @var string */
    protected string $placeholder = '';

    /**
     * @param string $value
     * @return AbstractField
     */
    public function placeholder(string $value): AbstractField
    {
        $this->placeholder = $value;

        return $this;
    }
}