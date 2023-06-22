<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\UrlField;
use Anthonypauwels\WpAcfBuilder\Fields\TextField;
use Anthonypauwels\WpAcfBuilder\Fields\EmailField;
use Anthonypauwels\WpAcfBuilder\Fields\NumberField;
use Anthonypauwels\WpAcfBuilder\Fields\SelectField;
use Anthonypauwels\WpAcfBuilder\Fields\PasswordField;
use Anthonypauwels\WpAcfBuilder\Fields\TextareaField;

/**
 * Class Placeholder
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Placeholder
{
    /** @var string */
    protected string $placeholder = '';

    /**
     * @param string $value
     * @return NumberField|Placeholder|EmailField|PasswordField|SelectField|TextareaField|TextField|UrlField
     */
    public function placeholder(string $value): self
    {
        $this->placeholder = $value;

        return $this;
    }
}