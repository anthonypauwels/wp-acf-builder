<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\Content;
use Anthonypauwels\WpAcfBuilder\Concerns\Placeholder;

/**
 * Class PasswordField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class PasswordField extends AbstractField
{
    use Placeholder, Content;

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::password, [
            'placeholder' => $this->placeholder,
            'append' => $this->append,
            'prepend' => $this->prepend,
        ] );
    }
}