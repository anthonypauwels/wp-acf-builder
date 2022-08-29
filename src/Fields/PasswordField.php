<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Content;
use Anthonypauwels\WpAcfBuilder\Concerns\Placeholder;

class PasswordField extends AbstractField
{
    use Placeholder, Content;

    /**
     * @return array
     */
    public function toArray():array
    {
        return array_merge(
            $this->genericExport('password'),
            [
                'placeholder' => $this->placeholder,
                'append' => $this->append,
                'prepend' => $this->prepend,
            ]
        );
    }
}