<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\MinMax;

/**
 * Class RelationshipField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class RelationshipField extends AbstractField
{
    use MinMax;

    /** @var array */
    protected array $postsTypes = [];

    /** @var array */
    protected array $taxonomies = [];

    /** @var string[] */
    protected array $filters = [
        'search',
        'post_type',
        'taxonomy'
    ];

    /** @var string */
    protected string $format = 'object';

    /**
     * @param array $taxonomies
     * @return $this
     */
    public function taxonomies(array $taxonomies): RelationshipField
    {
        $this->taxonomies = $taxonomies;

        return $this;
    }

    /**
     * @param array $posts_type
     * @return $this
     */
    public function postsType(array $posts_type): RelationshipField
    {
        $this->postsTypes = $posts_type;

        return $this;
    }

    /**
     * @param array $values
     * @return $this
     */
    public function filters(array $values): RelationshipField
    {
        foreach ( $values as $key => $value ) {
            if ( in_array( $key, ['search', 'post_type', 'taxonomy'] ) && is_bool( $value ) ) {
                $this->filters[ $key ] = $value;
            }
        }

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function filterOnSearch(bool $value = true): RelationshipField
    {
        $this->filters( ['search' => $value ] );

        return $this;
    }

    /**
     * @return $this
     */
    public function dontFilterOnSearch(): RelationshipField
    {
        return $this->filterOnSearch( false );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function filterByPostType(bool $value = true): RelationshipField
    {
        $this->filters( ['post_type' => $value ] );

        return $this;
    }

    /**
     * @return $this
     */
    public function dontFilterByPostType(): RelationshipField
    {
        return $this->filterByPostType( false );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function filterByTaxonomy(bool $value = true): RelationshipField
    {
        $this->filters( ['taxonomy' => $value ] );

        return $this;
    }

    /**
     * @return $this
     */
    public function dontFilterByTaxonomy(): RelationshipField
    {
        return $this->filterByTaxonomy( false );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): RelationshipField
    {
        if ( in_array( $value, ['object', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function returnObject(): RelationshipField
    {
        return $this->return('object');
    }

    /**
     * @return $this
     */
    public function returnId(): RelationshipField
    {
        return $this->return('id');
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onQuery(callable $callback): AbstractField
    {
        add_filter('acf/fields/relationship/query/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onResult(callable $callback): AbstractField
    {
        add_filter('acf/fields/relationship/result/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Builder::relationship, [
            'post_type' => !empty( $this->postsTypes ) ? $this->postsTypes : '',
            'taxonomy' => !empty( $this->taxonomies ) ? $this->taxonomies : '',
            'filters' => array_keys( $this->filters ),
            'min' => $this->min,
            'max' => $this->max,
            'return_format' => $this->format,
        ] );
    }
}