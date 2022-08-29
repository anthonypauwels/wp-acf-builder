<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Content;
use Anthonypauwels\WpAcfBuilder\Concerns\Disabled;
use Anthonypauwels\WpAcfBuilder\Concerns\ReadOnly;
use Anthonypauwels\WpAcfBuilder\Concerns\MaxLength;
use Anthonypauwels\WpAcfBuilder\Concerns\Placeholder;

class TextField extends AbstractField
{
    use Placeholder, Content, ReadOnly, Disabled, MaxLength;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            $this->genericExport('text'),
            [
                'placeholder' => $this->placeholder,
                'append' => $this->append,
                'prepend' => $this->prepend,
                'maxlength' => $this->maxLength === 0 ? '' : $this->maxLength,
                'readonly' => (int) $this->readOnly,
                'disabled' => (int) $this->disabled,
            ]
        );
    }
}