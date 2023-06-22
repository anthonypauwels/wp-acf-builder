<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Flexible;
use Anthonypauwels\WpAcfBuilder\Repeater;
use Anthonypauwels\WpAcfBuilder\Fields\GalleryField;
use Anthonypauwels\WpAcfBuilder\Fields\RelationshipField;

/**
 * Class MinMax
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait MinMax
{
    /** @var int */
    protected int $min = 0;

    /** @var int */
    protected int $max = 0;

    /**
     * @param int $value
     * @return Flexible|MinMax|GalleryField|RelationshipField|Repeater
     */
    public function min(int $value):self
    {
        $this->min = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return Flexible|MinMax|GalleryField|RelationshipField|Repeater
     */
    public function max(int $value):self
    {
        $this->max = $value;

        return $this;
    }
}