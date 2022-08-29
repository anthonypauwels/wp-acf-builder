<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Nullable;

class TaxonomyField extends AbstractField
{
    use Nullable;

    /** @var string */
    protected string $taxonomy = 'category';

    /** @var string */
    protected string $appearance = 'checkbox';

    /** @var bool */
    protected bool $saveTerms = false;

    /** @var string */
    protected string $format = 'id';

    /** @var bool */
    protected bool $allowAddTerm = true;

    /**
     * @param string $value
     * @return $this
     */
    public function which(string $value): TaxonomyField
    {
        $this->taxonomy = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function appearance(string $value): TaxonomyField
    {
        if ( in_array( $value, ['checkbox', 'multi_select', 'radio', 'select'] ) ) {
            $this->appearance = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function asCheckbox(): TaxonomyField
    {
        return $this->appearance('checkbox');
    }

    /**
     * @return $this
     */
    public function asMultiSelect(): TaxonomyField
    {
        return $this->appearance('multi_select');
    }

    /**
     * @return $this
     */
    public function asRadio(): TaxonomyField
    {
        return $this->appearance('radio');
    }

    /**
     * @return $this
     */
    public function asSelect(): TaxonomyField
    {
        return $this->appearance('select');
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function saveTerms(bool $value = true): TaxonomyField
    {
        $this->saveTerms = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function dontSaveTerms(): TaxonomyField
    {
        return $this->saveTerms( false );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): TaxonomyField
    {
        if ( in_array( $value, ['object', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function returnObject(): TaxonomyField
    {
        return $this->return('object');
    }

    /**
     * @return $this
     */
    public function returnId(): TaxonomyField
    {
        return $this->return('id');
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function allowAddTerm(bool $value = true): TaxonomyField
    {
        $this->allowAddTerm = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function disallowAddTerm(): TaxonomyField
    {
        return $this->allowAddTerm( false );
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onQuery(callable $callback): AbstractField
    {
        add_filter('acf/fields/taxonomy/query/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onResult(callable $callback): AbstractField
    {
        add_filter('acf/fields/taxonomy/result/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            $this->genericExport('taxonomy'),
            [
                'taxonomy' => $this->taxonomy,
                'field_type' => $this->appearance,
                'allow_null' => (int) $this->nullable,
                'load_save_terms' => (int) $this->saveTerms,
                'return_format' => $this->format,
                'add_term' => (int) $this->allowAddTerm,
            ]
        );
    }
}