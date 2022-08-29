<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Multiple;
use Anthonypauwels\WpAcfBuilder\Concerns\Nullable;

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
        return array_merge(
            $this->genericExport('user'),
            [
                'role' => $this->roles,
                'allow_null' => (int) $this->nullable,
                'multiple' => (int) $this->multiple,
            ]
        );
    }
}