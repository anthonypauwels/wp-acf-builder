<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\UserField;
use Anthonypauwels\WpAcfBuilder\Fields\SelectField;
use Anthonypauwels\WpAcfBuilder\Fields\PageLinkField;
use Anthonypauwels\WpAcfBuilder\Fields\TaxonomyField;
use Anthonypauwels\WpAcfBuilder\Fields\ButtonGroupField;
use Anthonypauwels\WpAcfBuilder\Fields\PostObjectField;

/**
 * Class Nullable
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Nullable
{
    /** @var bool */
    protected bool $nullable = false;

    /**
     * @param bool $value
     * @return ButtonGroupField|Nullable|PageLinkField|PostObjectField|SelectField|TaxonomyField|UserField
     */
    public function nullable(bool $value = true): self
    {
        $this->nullable = $value;

        return $this;
    }

    /**
     * @return ButtonGroupField|Nullable|PageLinkField|PostObjectField|SelectField|TaxonomyField|UserField
     */
    public function notNullable(): self
    {
        return $this->nullable( false );
    }
}