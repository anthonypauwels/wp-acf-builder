<?php
namespace Anthonypauwels\WpAcfBuilder;

use Closure;
use InvalidArgumentException;
use Anthonypauwels\WpAcfBuilder\Contracts\Field;
use Anthonypauwels\WpAcfBuilder\Fields\TabField;
use Anthonypauwels\WpAcfBuilder\Fields\UrlField;
use Anthonypauwels\WpAcfBuilder\Fields\TimeField;
use Anthonypauwels\WpAcfBuilder\Fields\UserField;
use Anthonypauwels\WpAcfBuilder\Fields\TextField;
use Anthonypauwels\WpAcfBuilder\Fields\LinkField;
use Anthonypauwels\WpAcfBuilder\Fields\FileField;
use Anthonypauwels\WpAcfBuilder\Fields\DateField;
use Anthonypauwels\WpAcfBuilder\Fields\ImageField;
use Anthonypauwels\WpAcfBuilder\Fields\EmailField;
use Anthonypauwels\WpAcfBuilder\Fields\RadioField;
use Anthonypauwels\WpAcfBuilder\Fields\RangeField;
use Anthonypauwels\WpAcfBuilder\Fields\ColorField;
use Anthonypauwels\WpAcfBuilder\Fields\SelectField;
use Anthonypauwels\WpAcfBuilder\Fields\NumberField;
use Anthonypauwels\WpAcfBuilder\Fields\OEmbedField;
use Anthonypauwels\WpAcfBuilder\Fields\MessageField;
use Anthonypauwels\WpAcfBuilder\Fields\GalleryField;
use Anthonypauwels\WpAcfBuilder\Fields\BooleanField;
use Anthonypauwels\WpAcfBuilder\Fields\WysiwygField;
use Anthonypauwels\WpAcfBuilder\Fields\TaxonomyField;
use Anthonypauwels\WpAcfBuilder\Fields\TextareaField;
use Anthonypauwels\WpAcfBuilder\Fields\DateTimeField;
use Anthonypauwels\WpAcfBuilder\Fields\CheckboxField;
use Anthonypauwels\WpAcfBuilder\Fields\PageLinkField;
use Anthonypauwels\WpAcfBuilder\Fields\PasswordField;
use Anthonypauwels\WpAcfBuilder\Fields\GoogleMapField;
use Anthonypauwels\WpAcfBuilder\Fields\AccordionField;
use Anthonypauwels\WpAcfBuilder\Fields\PostObjectField;
use Anthonypauwels\WpAcfBuilder\Fields\ButtonGroupField;
use Anthonypauwels\WpAcfBuilder\Fields\RelationshipField;
use Anthonypauwels\WpAcfBuilder\Contracts\Group as GroupInterface;

/**
 * Class Builder
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class Builder
{
    /** @var string[] */
    static protected array $namespaces = [];

    /** @var Location[] */
    static protected array $markedForBuild = [];

    /** @var array */
    static protected array $config = [];

    /** @var string */
    const all = 'all';

    /** @var string */
    const accordion = 'accordion';

    /** @var string */
    const boolean = 'true_false';

    /** @var string */
    const buttonGroup = 'button_group';

    /** @var string */
    const checkbox = 'checkbox';

    /** @var string */
    const color = 'color_picker';

    /** @var string */
    const date = 'date_picker';

    /** @var string */
    const dateTime = 'date_time_picker';

    /** @var string */
    const email = 'email';

    /** @var string */
    const file = 'file';

    /** @var string */
    const gallery = 'gallery';

    /** @var string */
    const googleMap = 'google_map';

    /** @var string */
    const image = 'image';

    /** @var string */
    const link = 'link';

    /** @var string */
    const message = 'message';

    /** @var string */
    const number = 'number';

    /** @var string */
    const oembed = 'oembed';

    /** @var string */
    const pageLink = 'page_link';

    /** @var string */
    const password = 'password';

    /** @var string */
    const postObject = 'post_object';

    /** @var string */
    const radio = 'radio';

    /** @var string */
    const range = 'range';

    /** @var string */
    const relationship = 'relationship';

    /** @var string */
    const select = 'select';

    /** @var string */
    const tab = 'tab';

    /** @var string */
    const taxonomy = 'taxonomy';

    /** @var string */
    const textarea = 'textarea';

    /** @var string */
    const text = 'text';

    /** @var string */
    const time = 'time_picker';

    /** @var string */
    const url = 'url';

    /** @var string */
    const user = 'user';

    /** @var string */
    const wysiwyg = 'wysiwyg';

    /** @var string */
    const flexible = 'flexible';

    /** @var string */
    const group = 'group';

    /** @var string */
    const layout = 'layout';

    /** @var string */
    const location = 'location';

    /** @var string */
    const repeater = 'repeater';

    /**
     * Build all groups marked for build
     *
     * @param Closure $closure
     * @return void
     */
    public static function build(Closure $closure): void
    {
        $closure();

        add_action('acf/init', function() {
            foreach ( self::$markedForBuild as $group ) {
                $group->build();
            }
        } );
    }

    /**
     * Create a namespace for pageTemplate groups
     *
     * @param string $namespace
     * @param Closure $closure
     */
    public static function namespace(string $namespace, Closure $closure): void
    {
        self::$namespaces[] = $namespace;

        $closure();

        array_pop( self::$namespaces );
    }

    /**
     * Create a group
     *
     * @param string $label
     * @param Closure $closure
     * @param string|null $name
     * @param string|null $key
     * @return Group
     */
    public static function fieldsGroup(string $label, Closure $closure, string $name = null, string $key = null): Group
    {
        return self::createGroup( $label, $closure, Group::class, $key, $name );
    }

    /**
     * Create a repeater
     *
     * @param string $label
     * @param Closure $closure
     * @param string|null $name
     * @param string|null $key
     * @return Repeater
     */
    public static function repeaterGroup(string $label, Closure $closure, string $name = null, string $key = null): Repeater
    {
        return self::createGroup( $label, $closure, Repeater::class, $key, $name );
    }

    /**
     * Create a flexible content
     *
     * @param string $label
     * @param Closure $closure
     * @param string|null $name
     * @param string|null $key
     * @return Flexible
     */
    public static function flexibleContent(string $label, Closure $closure, string $name = null, string $key = null): Flexible
    {
        return self::createGroup( $label, $closure, Flexible::class, $key, $name );
    }

    /**
     * Create a simple Location group
     *
     * @param string $title
     * @param Closure $closure
     * @param string|null $key
     * @param bool $build
     * @return Location
     */
    public static function locationGroup(string $title, Closure $closure, string|null $key = null, bool $build = true): Location
    {
        /** @var Location $group */
        $group = self::createGroup( $title, $closure, Location::class, $key );

        if ( $build ) {
            self::$markedForBuild[] = $group;
        }

        return $group;
    }

    /**
     * Create a fields group for the given post type
     *
     * @param string $post_type
     * @param string $title
     * @param Closure $closure
     * @param string|null $key
     * @param bool $build
     * @return Location
     */
    public static function postType(string $post_type, string $title, Closure $closure, string $key = null, bool $build = true): Location
    {
        /** @var Location $group */
        $group = self::createGroup( $title, $closure, Location::class, $key );
        $group->postType( $post_type );

        if ( $build ) {
            self::$markedForBuild[] = $group;
        }

        return $group;
    }

    /**
     * Create a fields group for the given page template
     *
     * @param string $template_name
     * @param string $title
     * @param Closure $closure
     * @param string|null $key
     * @param bool $build
     * @return Location
     */
    public static function pageTemplate(string $template_name, string $title, Closure $closure, string $key = null, bool $build = true): Location
    {
        $namespaces = self::$namespaces;
        $namespaces[] = $template_name;

        $full_template_path = implode(DIRECTORY_SEPARATOR, $namespaces );

        /** @var Location $group */
        $group = self::createGroup( $title, $closure, Location::class, $key );
        $group->pageTemplate( $full_template_path );

        if ( $build ) {
            self::$markedForBuild[] = $group;
        }

        return $group;
    }

    /**
     * Create a fields group for Options Page
     *
     * @param string $title
     * @param Closure $closure
     * @param string $page
     * @param bool $build
     * @return Location
     */
    public static function optionsPage(string $title, Closure $closure, string $page = 'options', bool $build = true): Location
    {
        /** @var Location $group */
        $group = self::createGroup( $title, $closure, Location::class, $page );
        $group->optionsPage( $page );

        if ( $build ) {
            self::$markedForBuild[] = $group;
        }

        return $group;
    }

    /**
     * Create a related AbstractGroup object
     *
     * @param string $title
     * @param Closure $closure
     * @param string $class_name
     * @param string|null $key
     * @param string|null $label
     * @return mixed
     */
    protected static function createGroup(string $title, Closure $closure, string $class_name = AbstractGroup::class, string|null $key = null, string|null $label = null): mixed
    {
        $group = new $class_name( $title, $key, $label );

        $closure( $group );

        return $group;
    }

    /**
     * Configure the ACF Builder
     *
     * @param array $config
     * @return void
     */
    public static function config(array $config): void
    {
        $config = array_map( function ( $field ) {
            if ( $field instanceof Field || $field instanceof GroupInterface ) {
                $field = $field->toArray();
            }

            if ( is_array( $field ) ) {
                /** Removing protected keys like key, name, label, type and sub_fields */
                return array_diff_key( $field, array_flip( ['key', 'name', 'label', 'type', 'sub_fields'] ) );
            }

            throw new InvalidArgumentException('Config array must only contains Field instances or arrays');
        }, $config );

        self::$config = array_merge( self::$config, $config );
    }

    /**
     * Get the configuration for a specific field
     *
     * @param string $config_name
     * @return array
     */
    public static function getFieldConfig(string $config_name): array
    {
        return array_merge(
            isset( self::$config[ self::all ] ) ? self::$config[ self::all ] : [],
            isset( self::$config[ $config_name ] ) ? self::$config[ $config_name ] : []
        );
    }

    /**
     * @return AccordionField
     */
    public static function accordion(): AccordionField
    {
        return new class extends AccordionField {};
    }

    /**
     * @return BooleanField
     */
    public static function boolean(): BooleanField
    {
        return new class extends BooleanField {};
    }

    /**
     * @return ButtonGroupField
     */
    public static function buttonGroup(): ButtonGroupField
    {
        return new class extends ButtonGroupField {};
    }

    /**
     * @return CheckboxField
     */
    public static function checkbox(): CheckboxField
    {
        return new class extends CheckboxField {};
    }

    /**
     * @return ColorField
     */
    public static function color(): ColorField
    {
        return new class extends ColorField {};
    }

    /**
     * @return DateField
     */
    public static function date(): DateField
    {
        return new class extends DateField {};
    }

    /**
     * @return DateTimeField
     */
    public static function dateTime(): DateTimeField
    {
        return new class extends DateTimeField {};
    }

    /**
     * @return EmailField
     */
    public static function email(): EmailField
    {
        return new class extends EmailField {};
    }

    /**
     * @return FileField
     */
    public static function file(): FileField
    {
        return new class extends FileField {};
    }

    /**
     * @return GalleryField
     */
    public static function gallery(): GalleryField
    {
        return new class extends GalleryField {};
    }

    /**
     * @return GoogleMapField
     */
    public static function googleMap(): GoogleMapField
    {
        return new class extends GoogleMapField {};
    }

    /**
     * @return ImageField
     */
    public static function image(): ImageField
    {
        return new class extends ImageField {};
    }

    /**
     * @return LinkField
     */
    public static function link(): LinkField
    {
        return new class extends LinkField {};
    }

    /**
     * @return MessageField
     */
    public static function message(): MessageField
    {
        return new class extends MessageField {};
    }

    /**
     * @return NumberField
     */
    public static function number(): NumberField
    {
        return new class extends NumberField {};
    }

    /**
     * @return OEmbedField
     */
    public static function OEmbed(): OEmbedField
    {
        return new class extends OEmbedField {};
    }

    /**
     * @return PageLinkField
     */
    public static function pageLink(): PageLinkField
    {
        return new class extends PageLinkField {};
    }

    /**
     * @return PasswordField
     */
    public static function password(): PasswordField
    {
        return new class extends PasswordField {};
    }

    /**
     * @return PostObjectField
     */
    public static function postObject(): PostObjectField
    {
        return new class extends PostObjectField {};
    }

    /**
     * @return RadioField
     */
    public static function radio(): RadioField
    {
        return new class extends RadioField {};
    }

    /**
     * @return RangeField
     */
    public static function range(): RangeField
    {
        return new class extends RangeField {};
    }

    /**
     * @return RelationshipField
     */
    public static function relationship(): RelationshipField
    {
        return new class extends RelationshipField {};
    }

    /**
     * @return SelectField
     */
    public static function select(): SelectField
    {
        return new class extends SelectField {};
    }

    /**
     * @return TabField
     */
    public static function tab(): TabField
    {
        return new class extends TabField {};
    }

    /**
     * @return TaxonomyField
     */
    public static function taxonomy(): TaxonomyField
    {
        return new class extends TaxonomyField {};
    }

    /**
     * @return TextareaField
     */
    public static function textarea(): TextareaField
    {
        return new class extends TextareaField {};
    }

    /**
     * @return TextField
     */
    public static function text(): TextField
    {
        return new class extends TextField {};
    }

    /**
     * @return TimeField
     */
    public static function time(): TimeField
    {
        return new class extends TimeField {};
    }

    /**
     * @return UrlField
     */
    public static function url(): UrlField
    {
        return new class extends UrlField {};
    }

    /**
     * @return UserField
     */
    public static function user(): UserField
    {
        return new class extends UserField {};
    }

    /**
     * @return WysiwygField
     */
    public static function wysiwyg(): WysiwygField
    {
        return new class extends WysiwygField {};
    }

    /**
     * @return Flexible
     */
    public static function flexible(): Flexible
    {
        return new class extends Flexible {};
    }

    /**
     * @return Group
     */
    public static function group(): Group
    {
        return new class extends Group {};
    }

    /**
     * @return Layout
     */
    public static function layout(): Layout
    {
        return new class extends Layout {};
    }

    /**
     * @return Location
     */
    public static function location(): Location
    {
        return new class extends Location {};
    }

    /**
     * @return Repeater
     */
    public static function repeater(): Repeater
    {
        return new class extends Repeater {};
    }
}