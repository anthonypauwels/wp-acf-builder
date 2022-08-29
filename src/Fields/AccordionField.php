<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

class AccordionField extends AbstractField
{
    /** @var bool */
    protected bool $open = false;

    /** @var bool */
    protected bool $multiExpand = false;

    /**
     * @param string $label
     * @param string|null $key
     */
    public function __construct(string $label, string $key = null)
    {
        parent::__construct( $label, '', $key );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function open(bool $value = true):AccordionField
    {
        $this->open = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function close():AccordionField
    {
        return $this->open( false );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function multiExpand(bool $value = true):AccordionField
    {
        $this->multiExpand = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function dontMultiExpand():AccordionField
    {
        return $this->multiExpand( false );
    }

    /**
     *
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            $this->genericExport('accordion'),
            [
                'open' => (int) $this->open,
                'multi_expand' => (int) $this->multiExpand,
            ]
        );
    }
}