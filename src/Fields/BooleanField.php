<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\Message;

/**
 * Class BooleanField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class BooleanField extends AbstractField
{
    use Message;

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::boolean, [
            'message' => $this->message,
        ] );
    }
}