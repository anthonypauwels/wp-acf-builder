<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\Multiple;
use Anthonypauwels\WpAcfBuilder\Concerns\Nullable;

/**
 * Class PostObjectField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class PostObjectField extends AbstractField
{
    use Nullable, Multiple;

    /** @var array */
    protected array $postsTypes = [];

    /** @var array */
    protected array $taxonomies = [];

    /** @var string */
    protected string $format = 'object';

    /**
     * @param array $taxonomies
     * @return $this
     */
    public function taxonomies(array $taxonomies): PostObjectField
    {
        $this->taxonomies = array_values( $taxonomies );

        return $this;
    }

    /**
     * @param array $posts_types
     * @return $this
     */
    public function postsType(array $posts_types): PostObjectField
    {
        $this->postsTypes = array_values( $posts_types );

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): PostObjectField
    {
        if ( in_array( $value, ['object', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function returnObject(): PostObjectField
    {
        return $this->return('object');
    }

    /**
     * @return $this
     */
    public function returnId(): PostObjectField
    {
        return $this->return('id');
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onQuery(callable $callback): AbstractField
    {
        add_filter('acf/fields/post_object/query/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onResult(callable $callback): AbstractField
    {
        add_filter('acf/fields/post_object/result/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Builder::postObject, [
            'post_type' => !empty( $this->postsTypes ) ? $this->postsTypes : '',
            'taxonomy' => !empty( $this->taxonomies ) ? $this->taxonomies : '',
            'allow_null' => (int) $this->nullable,
            'multiple' => (int) $this->multiple,
            'return_format' => $this->format,
        ] );
    }
}