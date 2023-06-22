<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\Multiple;
use Anthonypauwels\WpAcfBuilder\Concerns\Nullable;

/**
 * Class PageLinkField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class PageLinkField extends AbstractField
{
    use Nullable, Multiple;

    /** @var string */
    protected string $postType = '';

    /** @var string */
    protected string $taxonomy = '';

    /**
     * @param string $value
     * @return $this
     */
    public function postType(string $value): PageLinkField
    {
        $this->postType = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function taxonomy(string $value): PageLinkField
    {
        $this->taxonomy = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::pageLink, [
            'post_type' => $this->postType,
            'taxonomy' => $this->taxonomy,
            'allow_null' => (int) $this->nullable,
            'multiple' => (int) $this->multiple,
        ] );
    }
}