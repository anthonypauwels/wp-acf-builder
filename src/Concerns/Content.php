<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\TextField;
use Anthonypauwels\WpAcfBuilder\Fields\RangeField;
use Anthonypauwels\WpAcfBuilder\Fields\EmailField;
use Anthonypauwels\WpAcfBuilder\Fields\NumberField;
use Anthonypauwels\WpAcfBuilder\Fields\PasswordField;
use Anthonypauwels\WpAcfBuilder\Fields\TextareaField;

/**
 * Class Content
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Content
{
    /** @var string */
    protected string $append = '';

    /** @var string */
    protected string $prepend = '';

    /**
     * @param string $content
     * @return NumberField|Content|EmailField|PasswordField|RangeField|TextareaField|TextField
     */
    public function append(string $content): self
    {
        $this->append = $content;

        return $this;
    }

    /**
     * @param string $content
     * @return NumberField|Content|EmailField|PasswordField|RangeField|TextareaField|TextField
     */
    public function prepend(string $content): self
    {
        $this->prepend = $content;

        return $this;
    }
}