<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

class DateTimeField extends DateField
{
    /** @var string */
    protected string $displayFormat = 'd/m/Y g:i a';

    /** @var string  */
    protected string $returnFormat = 'd/m/Y g:i a';

    /**
     * @return array
     */
    public function toArray():array
    {
        return array_merge(
            $this->genericExport('date_time_picker'),
            [
                'display_format' => $this->displayFormat,
                'return_format' => $this->returnFormat,
                'first_day' => $this->weekStartsOn,
            ]
        );
    }
}