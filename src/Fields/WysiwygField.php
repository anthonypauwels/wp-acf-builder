<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;

/**
 * Class Wysiwyg
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class WysiwygField extends AbstractField
{
    /** @var string */
    protected string $tabs = 'all';

    /** @var string */
    protected string $toolbar = 'full';

    /** @var bool */
    protected bool $mediaUpload = true;

    /**
     * @param string $value
     * @return $this
     */
    public function tabs(string $value): WysiwygField
    {
        if ( in_array( $value, ['all', 'visual', 'text'] ) ) {
            $this->tabs = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function allTabs(): WysiwygField
    {
        return $this->tabs( 'all' );
    }

    /**
     * @return $this
     */
    public function visualOnly(): WysiwygField
    {
        return $this->tabs( 'visual' );
    }

    /**
     * @return $this
     */
    public function textOnly(): WysiwygField
    {
        return $this->tabs( 'text' );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function toolbar(string $value): WysiwygField
    {
        if ( in_array( $value, [ 'full', 'basic' ] ) ) {
            $this->toolbar = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function fullToolbar(): WysiwygField
    {
        return $this->toolbar( 'full' );
    }

    /**
     * @return $this
     */
    public function basicToolbar(): WysiwygField
    {
        return $this->toolbar( 'basic' );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function showMediaButton(bool $value = true): WysiwygField
    {
        $this->mediaUpload = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function hideMediaButton(): WysiwygField
    {
        return $this->showMediaButton( false );
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::wysiwyg, [
            'tabs' => $this->tabs,
            'toolbar' => $this->toolbar,
            'media_upload' => (int) $this->mediaUpload,
        ] );
    }
}