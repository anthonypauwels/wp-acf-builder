<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\AbstractGroup;
use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

/**
 * Class DefaultValue
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait DefaultValue
{
    /** @var string */
    protected string $default = '';

    /**
     * @param string $default
     * @return DefaultValue|AbstractGroup|AbstractField
     */
    public function default(string $default): self
    {
        $this->default = $default;

        return $this;
    }
}