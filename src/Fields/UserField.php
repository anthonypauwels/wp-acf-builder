<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\Multiple;
use Anthonypauwels\WpAcfBuilder\Concerns\Nullable;

/**
 * Class UserField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class UserField extends AbstractField
{
    use Nullable, Multiple;

    /** @var array */
    protected array $roles = [];

    /**
     * @param array $roles
     * @return $this
     */
    public function roles(array $roles): UserField
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::user, [
            'role' => $this->roles,
            'allow_null' => (int) $this->nullable,
            'multiple' => (int) $this->multiple,
        ] );
    }
}