<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\UserField;
use Anthonypauwels\WpAcfBuilder\Fields\SelectField;
use Anthonypauwels\WpAcfBuilder\Fields\PageLinkField;
use Anthonypauwels\WpAcfBuilder\Fields\PostObjectField;

/**
 * Class Multiple
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Multiple
{
    /** @var bool */
    protected bool $multiple = false;

    /**
     * @param bool $value
     * @return SelectField|Multiple|PageLinkField|PostObjectField|UserField
     */
    public function multiple(bool $value = true): self
    {
        $this->multiple = $value;

        return $this;
    }

    /**
     * @return SelectField|Multiple|PageLinkField|PostObjectField|UserField
     */
    public function notMultiple(): self
    {
        return $this->multiple( false );
    }
}