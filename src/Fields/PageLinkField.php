<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Multiple;
use Anthonypauwels\WpAcfBuilder\Concerns\Nullable;

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
        return array_merge(
            $this->genericExport('page_link'),
            [
                'post_type' => $this->postType,
                'taxonomy' => $this->taxonomy,
                'allow_null' => (int) $this->nullable,
                'multiple' => (int) $this->multiple,
            ]
        );
    }
}