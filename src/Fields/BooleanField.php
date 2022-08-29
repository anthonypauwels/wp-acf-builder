<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Message;

class BooleanField extends AbstractField
{
    use Message;

    /**
     * @return array
     */
    public function toArray():array
    {
        return array_merge(
            $this->genericExport('true_false'),
            [
                'message' => $this->message,
            ]
        );
    }
}