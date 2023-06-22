<?php namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\Content;
use Anthonypauwels\WpAcfBuilder\Concerns\Disabled;
use Anthonypauwels\WpAcfBuilder\Concerns\NewLines;
use Anthonypauwels\WpAcfBuilder\Concerns\ReadOnly;
use Anthonypauwels\WpAcfBuilder\Concerns\MaxLength;
use Anthonypauwels\WpAcfBuilder\Concerns\Placeholder;

/**
 * Class TextareaField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class TextareaField extends AbstractField
{
    use Content, Placeholder, Disabled, ReadOnly, MaxLength, NewLines;

    /** @var int */
    protected int $rows = 0;

    /**
     * @param int $value
     * @return $this
     */
    public function rows(int $value): TextareaField
    {
        $this->rows = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::textarea, [
            'placeholder' => $this->placeholder,
            'rows' => $this->rows > 0 ? $this->rows : '',
            'new_lines' => $this->newLines,
            'maxlength' => $this->maxLength > 0 ? $this->maxLength : '',
            'readonly' => $this->readOnly,
            'disabled' => $this->disabled,
        ] );
    }
}