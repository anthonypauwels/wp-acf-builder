<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Placeholder;

class UrlField extends AbstractField
{
    use Placeholder;

    /**
     * @return array
     */
    public function toArray():array
    {
        return array_merge(
            $this->genericExport('url'),
            [
                'placeholder' => $this->placeholder,
            ]
        );
    }
}