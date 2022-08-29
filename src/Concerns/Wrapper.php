<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Wrapper
{
    /** @var array */
    protected array $wrapperAttributes = [
        'width' => '',
        'class' => '',
        'id'    => '',
    ];

    /**
     * @param int $width
     * @param string $class_list
     * @param string $id
     * @return AbstractField
     */
    public function wrapper(int $width, string $class_list, string $id): AbstractField
    {
        return $this->wrapperWidth( $width )->wrapperClass( $class_list )->wrapperId( $id );
    }

    /**
     * @param int $width
     * @return AbstractField
     */
    public function wrapperWidth(int $width): AbstractField
    {
        $this->wrapperAttributes['width'] = $width;

        return $this;
    }

    /**
     * @param string $class_list
     * @return AbstractField
     */
    public function wrapperClass(string $class_list): AbstractField
    {
        $this->wrapperAttributes['class'] = $class_list;

        return $this;
    }

    /**
     * @param string $id
     * @return AbstractField
     */
    public function wrapperId(string $id): AbstractField
    {
        $this->wrapperAttributes['id'] = $id;

        return $this;
    }
}