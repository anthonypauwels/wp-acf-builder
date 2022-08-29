<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

class TimeField extends AbstractField
{
    /** @var string */
    protected string $displayFormat = 'g:i a';

    /** @var string  */
    protected string $returnFormat = 'g:i a';

    /**
     * @param string $value
     * @return $this
     */
    public function display(string $value): TimeField
    {
        $this->displayFormat = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): TimeField
    {
        $this->returnFormat = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return array_merge(
            $this->genericExport('time_picker'),
            [
                'display_format' => $this->displayFormat,
                'return_format' => $this->returnFormat,
            ]
        );
    }
}