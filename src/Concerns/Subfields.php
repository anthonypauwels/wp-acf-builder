<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Closure;
use Anthonypauwels\WpAcfBuilder\Group;
use Anthonypauwels\WpAcfBuilder\Layout;
use Anthonypauwels\WpAcfBuilder\Location;
use Anthonypauwels\WpAcfBuilder\Flexible;
use Anthonypauwels\WpAcfBuilder\Repeater;
use Anthonypauwels\WpAcfBuilder\Contracts\Field;
use Anthonypauwels\WpAcfBuilder\Fields\TabField;
use Anthonypauwels\WpAcfBuilder\Fields\UrlField;
use Anthonypauwels\WpAcfBuilder\Fields\DateField;
use Anthonypauwels\WpAcfBuilder\Fields\LinkField;
use Anthonypauwels\WpAcfBuilder\Fields\TimeField;
use Anthonypauwels\WpAcfBuilder\Fields\FileField;
use Anthonypauwels\WpAcfBuilder\Fields\TextField;
use Anthonypauwels\WpAcfBuilder\Fields\UserField;
use Anthonypauwels\WpAcfBuilder\Fields\ColorField;
use Anthonypauwels\WpAcfBuilder\Fields\EmailField;
use Anthonypauwels\WpAcfBuilder\Fields\ImageField;
use Anthonypauwels\WpAcfBuilder\Fields\RangeField;
use Anthonypauwels\WpAcfBuilder\Fields\NumberField;
use Anthonypauwels\WpAcfBuilder\Fields\OEmbedField;
use Anthonypauwels\WpAcfBuilder\Fields\SelectField;
use Anthonypauwels\WpAcfBuilder\Fields\WysiwygField;
use Anthonypauwels\WpAcfBuilder\Fields\BooleanField;
use Anthonypauwels\WpAcfBuilder\Fields\GalleryField;
use Anthonypauwels\WpAcfBuilder\Fields\MessageField;
use Anthonypauwels\WpAcfBuilder\Fields\CheckboxField;
use Anthonypauwels\WpAcfBuilder\Fields\TaxonomyField;
use Anthonypauwels\WpAcfBuilder\Fields\TextareaField;
use Anthonypauwels\WpAcfBuilder\Fields\PageLinkField;
use Anthonypauwels\WpAcfBuilder\Fields\DateTimeField;
use Anthonypauwels\WpAcfBuilder\Fields\PasswordField;
use Anthonypauwels\WpAcfBuilder\Fields\AccordionField;
use Anthonypauwels\WpAcfBuilder\Fields\GoogleMapField;
use Anthonypauwels\WpAcfBuilder\Fields\PostObjectField;
use Anthonypauwels\WpAcfBuilder\Fields\ButtonGroupField;
use Anthonypauwels\WpAcfBuilder\Fields\RelationshipField;

/**
 * Class Subfields
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Subfields
{
    /** @var array */
    protected array $fields = [];

    /**
     * @param Field $field
     * @return Repeater|Subfields|Group|Layout|Location
     */
    public function addField(Field $field):self
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * @param array $fields
     * @return Repeater|Subfields|Group|Layout|Location
     */
    public function prependFields(array $fields):self
    {
        $this->fields = array_reverse( $this->fields );
        $fields = array_reverse( $fields );

        foreach ( $fields as $field ) {
            $this->addField( $field );
        }

        $this->fields = array_reverse( $this->fields );

        return $this;
    }

    /**
     * @param array $fields
     * @return Repeater|Subfields|Group|Layout|Location
     */
    public function appendFields(array $fields):self
    {
        foreach ( $fields as $field ) {
            $this->addField( $field );
        }

        return $this;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return TextField
     */
    public function text(string $label, string $name = null, string $key = null): TextField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new TextField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return TextareaField
     */
    public function textarea(string $label, string $name = null, string $key = null): TextareaField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new TextareaField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return WysiwygField
     */
    public function wysiwyg(string $label, string $name = null, string $key = null): WysiwygField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new WysiwygField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return NumberField
     */
    public function number(string $label, string $name = null, string $key = null): NumberField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new NumberField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return EmailField
     */
    public function email(string $label, string $name = null, string $key = null): EmailField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new EmailField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return UrlField
     */
    public function url(string $label, string $name = null, string $key = null): UrlField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new UrlField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return BooleanField
     */
    public function boolean(string $label, string $name = null, string $key = null): BooleanField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new BooleanField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return PageLinkField
     */
    public function pageLink(string $label, string $name = null, string $key = null): PageLinkField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new PageLinkField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return PostObjectField
     */
    public function postObject(string $label, string $name = null, string $key = null): PostObjectField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new PostObjectField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return FileField
     */
    public function file(string $label, string $name = null, string $key = null): FileField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new FileField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return ImageField
     */
    public function image(string $label, string $name = null, string $key = null): ImageField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new ImageField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return GalleryField
     */
    public function gallery(string $label, string $name = null, string $key = null): GalleryField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new GalleryField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return SelectField
     */
    public function select(string $label, string $name = null, string $key = null): SelectField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new SelectField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return CheckboxField
     */
    public function checkbox(string $label, string $name = null, string $key = null): CheckboxField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new CheckboxField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return UserField
     */
    public function user(string $label, string $name = null, string $key = null): UserField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new UserField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return PasswordField
     */
    public function password(string $label, string $name = null, string $key = null): PasswordField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new PasswordField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return TaxonomyField
     */
    public function taxonomy(string $label, string $name = null, string $key = null): TaxonomyField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new TaxonomyField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return RelationshipField
     */
    public function relationship(string $label, string $name = null, string $key = null): RelationshipField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new RelationshipField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return OEmbedField
     */
    public function oEmbed(string $label, string $name = null, string $key = null): OEmbedField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new OEmbedField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return GoogleMapField
     */
    public function googleMap(string $label, string $name = null, string $key = null): GoogleMapField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new GoogleMapField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return LinkField
     */
    public function link(string $label, string $name = null, string $key = null): LinkField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new LinkField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return DateField
     */
    public function date(string $label, string $name = null, string $key = null): DateField
    {
        $field = new DateField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return TimeField
     */
    public function time(string $label, string $name = null, string $key = null): TimeField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new TimeField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return DateTimeField
     */
    public function dateTime(string $label, string $name = null, string $key = null): DateTimeField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new DateTimeField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return ButtonGroupField
     */
    public function buttonGroup(string $label, string $name = null, string $key = null): ButtonGroupField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new ButtonGroupField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return ColorField
     */
    public function color(string $label, string $name = null, string $key = null): ColorField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new ColorField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return RangeField
     */
    public function range(string $label, string $name = null, string $key = null): RangeField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new RangeField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     * @return MessageField
     */
    public function message(string $label, string $name = null, string $key = null): MessageField
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $field = new MessageField( $label, $name, $this->key . '_' . $key );

        $this->addField( $field );

        return $field;
    }

    /**
     * @param string $label
     * @param string|null $key
     * @return TabField
     */
    public function tab(string $label, string $key = null): TabField
    {
        if ( $key === null ) {
            $key = $label;
        }

        $tab = new TabField( $label, $key );

        $this->addField( $tab );

        return $tab;
    }

    /**
     * @param string $label
     * @param string|null $key
     * @return AccordionField
     */
    public function accordion(string $label, string $key = null): AccordionField
    {
        if ( $key === null ) {
            $key = $label;
        }

        $accordion = new AccordionField( $label, $key );

        $this->addField( $accordion );

        return $accordion;
    }

    /**
     * @param string $label
     * @param Closure $closure
     * @param string|null $name
     * @param string|null $key
     * @return Group
     */
    public function group(string $label, Closure $closure, string $name = null, string $key = null): Group
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $group = new Group( $label, $name, $this->key . '_' . $key );

        $this->addField( $group );

        $closure->call( $group, $group );

        return $group;
    }

    /**
     * @param string $label
     * @param Closure $closure
     * @param string|null $name
     * @param string|null $key
     * @return Repeater
     */
    public function repeater(string $label, Closure $closure, string $name = null, string $key = null): Repeater
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $repeater = new Repeater( $label, $name, $this->key . '_' . $key );

        $this->addField( $repeater );

        $closure->call( $repeater, $repeater );

        return $repeater;
    }

    /**
     * @param string $label
     * @param Closure $closure
     * @param string|null $name
     * @param string|null $key
     * @return Flexible
     */
    public function flexible(string $label, Closure $closure, string $name = null, string $key = null): Flexible
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $flexible = new Flexible( $label, $name, $this->key . '_' . $key );

        $this->addField( $flexible );

        $closure->call( $flexible, $flexible );

        return $flexible;
    }
}