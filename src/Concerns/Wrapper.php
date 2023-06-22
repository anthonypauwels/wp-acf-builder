<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\AbstractGroup;
use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

/**
 * Class Wrapper
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
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
     * @return Wrapper|AbstractGroup|AbstractField
     */
    public function wrapper(int $width, string $class_list, string $id): self
    {
        return $this->wrapperWidth( $width )->wrapperClass( $class_list )->wrapperId( $id );
    }

    /**
     * @param int $width
     * @return $this
     */
    public function wrapperWidth(int $width): self
    {
        $this->wrapperAttributes['width'] = $width;

        return $this;
    }

    /**
     * @param string $class_list
     * @return Wrapper|AbstractGroup|AbstractField
     */
    public function wrapperClass(string $class_list): self
    {
        $this->wrapperAttributes['class'] = $class_list;

        return $this;
    }

    /**
     * @param string $id
     * @return Wrapper|AbstractGroup|AbstractField
     */
    public function wrapperId(string $id): self
    {
        $this->wrapperAttributes['id'] = $id;

        return $this;
    }
}