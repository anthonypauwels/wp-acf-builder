<?php
namespace Anthonypauwels\WpAcfBuilder;

use Closure;

class Builder
{
    /** @var string[] */
    static protected array $namespaces = [];

    /** @var Location[] */
    static protected array $markedForBuild = [];

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
    public static function group(string $label, Closure $closure, string $name = null, string $key = null): Group
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
    public static function repeater(string $label, Closure $closure, string $name = null, string $key = null): Repeater
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
    public static function flexible(string $label, Closure $closure, string $name = null, string $key = null): Flexible
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
    public static function location(string $title, Closure $closure, string|null $key = null, bool $build = true): Location
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
    public static function options(string $title, Closure $closure, string $page = 'options', bool $build = true): Location
    {
        /** @var Location $group */
        $group = self::createGroup( $title, $closure, Location::class, $page );
        $group->options();

        if ( $build ) {
            self::$markedForBuild[] = $group;
        }

        return $group;
    }

    /**
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

        $closure->call( $group, $group );

        return $group;
    }
}