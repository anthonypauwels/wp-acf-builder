# WP ACF Builder

Create ACF fields with ease using a fluent API. 

Requiring WordPress with Advanced Custom Fields Pro.

## Installation

Require this package with composer.

```shell
composer require anthonypauwels/wp-acf-builder
```

## Usage

### Basic

The main Builder class provides shortcut methods to help you create your fields. Here is an example of creating fields for your home page template :

```php
$home_group = Builder::pageTemplate('templates/home.php', 'Home Page', function ( Location $group ) {
    $group->group('Header', function ( Group $group ) {
        $group->text('Title');
        $group->text('Tagline');
        $group->text('Button');

        $group->group('Background', function ( Group $group ) {
            $group->text('Video');
            $group->image('Image')->returnUrl();
        } );
    } );

    $group->group('Discover', function ( Group $group ) {
        $group->repeater('Subsection', function ( Repeater $group ) {
            $group->text('Title');
            $group->text('Subtitle');
            $group->wysiwyg('Content');
            $group->image('Image')->returnUrl();

            $group->group('Button', function ( Group $group ) {
                $group->text('Title');
                $group->pageLink('Page')->postType('page');
            } );
        } );
    } );

    $group->group('Blog', function ( Group $group ) {
        $group->text('Title');
        $group->text('Subtitle');

        $group->group('Button', function ( Group $group ) {
            $group->text('Title');
            $group->pageLink('Page')->postType('page');
        } );
    } );
} )->hideAll();

// group is stored into `$home_group` but not already build. You can call the method $home_group->build() to build the group into ACF. 
``` 

Builder class provides methods to build fields group for Posts Types, Options Pages and Page Template. Location group also provides helpers methods to show them using conditional parameters :

```php
Builder::postType('post', 'Post Field', function ( Location $group ) {
    // ...
    
    $group->postType('another_post_type', 'or'); // second parameter is optional and can be `or` or `and`
} );
```

Group instances that can exports sub_fields provides helpers methods to create them. It concerns Group, Layout, Location and Repeater. 
These methods help you to create subfields like TextField, TextareaField, ImageField, etc. Each class has its own helpers to configure themselves.

For example, you can define how the value of an image field must be returned using helpers methods like `returnUrl()`, `returnArray()` or `returnId()`

Groups with subfields helpers can also create subgroups using the same way. A Location can use `repeater($name, $closure)` to create a repeater field on its own.

The helpers to create group (Repeater, Group, Layout) accept a closure with instance on parameter that provides the same API to configure fields.

### Build

You can build your group separately using their method `build`.

```php
$home_group->build(); // see example above
$about_group->build();
$contact_group->build();
```

Builder class provides a static method `build()` that accepts a closure as parameter. This method calls the closure first then create the `acf/init` action. Every group created inside the closure will be internally marked for build and built inside the WordPress action.
Using that way, you do not need to call the `build()` method of each group, Builder will make it for you.

```php
Builder::build( function () {
    Builder::pageTemplate('templates/home.php', 'Home Page', function ( Location $group ) {
        // ...
    } );
} );
```

If you want to export your fields into a separate file, you can also require it into the closure :

```php
## AcfServiceProvider.php, by example
Builder::build( function () {
    require 'acf.php';
} );
```

```php
## acf.php
Builder::pageTemplate('templates/home.php', 'Home Page', function ( Location $group ) {
// ...
} );

Builder::pageTemplate('templates/about.php', 'About Page', function ( Location $group ) {
// ...
} );

Builder::pageTemplate('templates/contact.php', 'Contact Page', function ( Location $group ) {
// ...
} );
```

### Namespace

The static method `Builder::namespace` can be used to wrap many `Builder::pageTemplate` calls. A namespace is simply a directory where your templates is stored.

```php
Builder::namespace( 'templates', function () {
    Builder::pageTemplate('home.php', 'Home Page', function ( Location $group ) {
        // ...
    } );
    
    Builder::pageTemplate('about.php', 'About Page', function ( Location $group ) {
        // ...
    } );
} );
```

### Reuse

Here is an example of creating a banner group with predefined fields. When your group is created, you can push them into the fields list of another groups like Location, Repeater and Layout.

```php
$banner_group = Builder::group('Banner', function (Group $group) {
    $group->text('Title');
    
    $group->text('Subtitle');
    
    $group->group('Button', function ( Group $group ) {
        $group->text('Title');
        $group->pageLink('Page')->postType('page');
    } );

    $group->group('Background', function ( Group $group ) {
        $group->text('Video');
        $group->image('Image')->returnUrl();
    } );
} );

Builder::pageTemplate('templates/home.php', 'Home Page', function ( Location $group ) use ( $banner_group ) {
    // ...
    $group->addField( $banner_group );
    // ...
} );

Builder::pageTemplate('templates/contact.php', 'Contact Page', function ( Location $group ) use ( $banner_group ) {
    // ...
    $group->addField( $banner_group );
    // ...
} );
```

### Filters

Fields inherit from `AbstractField` class that provides helpers for ACF filters. For example, you can create a filter where the returned value is transformed into capital case.

```php
Builder::namespace( 'templates', function () {
    Builder::pageTemplate('home.php', 'Home Page', function ( Location $group ) {
        $group->text('Title')->onValue( function ( $field ) {
            $field['value'] = strtoupper( $field['value'] );
        
            return $field;
        } );
    } );
} );
```

For more information about ACF filters, check the Advanced Custom Fields [documentation about Filters](https://www.advancedcustomfields.com/resources/#filters).

### API documentation

WP ACF Builder provides a fluent API for each instances available.

- [Builder](#builder)
- [Subfields](#subfields)
- [Flexible Content](#flexible-content)
- [Group](#group)
- [Layout Group](#layout-group)
- [Location Group](#location-group)
- [Repeater Group](#repeater-group)
- [AbstractField](#abstractfield)
- [AccordionField](#accordionfield)
- [BooleanField](#booleanfield)
- [ButtonGroupField](#buttongroupfield)
- [CheckboxField](#checkboxfield)
- [ColorField](#colorfield)
- [DateField](#datefield)
- [DateTimeField](#datetimefield)
- [EmailField](#emailfield)
- [FileField](#filefield)
- [GalleryField](#galleryfield)
- [GoogleMapField](#googlemapfield)
- [ImageField](#imagefield)
- [LinkField](#linkfield)
- [MessageField](#messagefield)
- [NumberField](#numberfield)
- [OEmbedField](#oembedfield)
- [PageLinkField](#pagelinkfield)
- [PasswordField](#passwordfield)
- [PostObjectField](#postobjectfield)
- [RadioField](#radiofield)
- [RangeField](#rangefield)
- [RelationshipField](#relationshipfield)
- [SelectField](#selectfield)
- [TabField](#tabfield)
- [TaxonomyField](#taxonomyfield)
- [TextareaField](#textareafield)
- [TextField](#textfield)
- [TimeField](#timefield)
- [UserField](#userfield)
- [WysiwygField](#wysiwygfield)
- [Generic methods](#generic-methods)

#### Builder
```php
Builder::build( function () { } );
Builder::namespace( 'templates', function () { } );
Builder::group( 'Group label', function ( Group $group ) { } );
Builder::repeater( 'Repeater label', function ( Repeater $repeater ) { } );
Builder::flexible( 'Flexible Content label', function ( Flexible $flexible ) { } );
Builder::location( 'Group Location label', function ( Location $location ) { } );
Builder::postType( 'Location Post Type', function ( Location $location ) { } );
Builder::pageTemplate( 'Location Page Template', function ( Location $location ) { } );
Builder::options( 'Location Options Page', function ( Location $location ) { } );
```

#### Subfields

Class `Group`, `Location`, `Layout` and `Repeater` use `Subfields` trait that provides the methods to create fields:

```php
$group->addField( $field ); // instance of Field
$group->prependFields( $fields ); // array of Field instances
$group->appendFields( $fields ); // array of Field instances
$group->text( 'Label', 'name', 'key' );
$group->textarea( 'Label', 'name', 'key' );
$group->wysiwyg( 'Label', 'name', 'key' );
$group->number( 'Label', 'name', 'key' );
$group->email( 'Label', 'name', 'key' );
$group->url( 'Label', 'name', 'key' );
$group->boolean( 'Label', 'name', 'key' );
$group->pageLink( 'Label', 'name', 'key' );
$group->postObject( 'Label', 'name', 'key' );
$group->file( 'Label', 'name', 'key' );
$group->image( 'Label', 'name', 'key' );
$group->gallery( 'Label', 'name', 'key' );
$group->select( 'Label', 'name', 'key' );
$group->checkbox( 'Label', 'name', 'key' );
$group->user( 'Label', 'name', 'key' );
$group->password( 'Label', 'name', 'key' );
$group->taxonomy( 'Label', 'name', 'key' );
$group->relationship( 'Label', 'name', 'key' );
$group->oEmbed( 'Label', 'name', 'key' );
$group->googleMap( 'Label', 'name', 'key' );
$group->link( 'Label', 'name', 'key' );
$group->date( 'Label', 'name', 'key' );
$group->time( 'Label', 'name', 'key' );
$group->dateTime( 'Label', 'name', 'key' );
$group->buttonGroup( 'Label', 'name', 'key' );
$group->color( 'Label', 'name', 'key' );
$group->range( 'Label', 'name', 'key' );
$group->message( 'Label', 'name', 'key' );
$group->tab( 'Label', 'key' );
$group->accordion( 'Label', 'key' );
$group->group( 'Label', function ( Group $group ) { }, 'name', 'key' );
$group->repeater( 'Label', function ( Repeater $repeater ) { }, 'name', 'key' );
$group->flexible( 'Label', function ( Flexible $flexible ) { }, 'name', 'key' );
```

#### Flexible Content
```php
$flexible->onLayoutTitle( function () { ... } ); // check ACF documentation about Flexible Content title filter
$flexible->layout('Layout Label', function ( Layout $layout ) { ... } );
$flexible->addLayout( $layout ); // instance of class Layout
$flexible->button('Add a layout');
$flexible->min(3); // default to 0
$flexible->max(9); // default to 0 (infinity)
```

#### Group
```php
$group->layout('block'); // block | table | row
$group->blockLayout();
$group->tableLayout();
$group->rowLayout();
```

#### Layout Group
```php
$layout->layout('block'); // block | table | row
$layout->blockLayout();
$layout->tableLayout();
$layout->rowLayout();
```

#### Location Group
```php
$location->showIf('page_template', '=', 'home.php', 'and');
$location->andShowIf('page_template', '=', 'home.php');
$location->orShowIf('page_template', '=', 'home.php');
$location->priorityOrder();
$location->position('normal'); // side | acf_after_title | normal
$location->positionOnSide();
$location->positionAfterTitle();
$location->positionBelow();
$location->style(); // default | seamless
$location->styleWithBox();
$location->styleWithoutBox();
$location->labelsOn('top'); // top | left
$location->labelsAboveFields();
$location->labelsBesideFields();
$location->instructionsBelow('label'); // label | field
$location->instructionsBelowLabels();
$location->instructionsBelowFields();
$location->hideOnScreen('revisions'); // hide listed elements
$location->hideAll('the_content', 'featured_image'); // list exceptions on parameters 
$location->enable(); // pass `false` to disable
$location->disable();
$location->showInApi(); // pass `false` to hide in API
$location->hideInApi();
$location->description('Group description');
$location->page(2434, 'and');
$location->pageParent(4244, 'and');
$location->pageTemplate('home.php', 'and');
$location->post(2424, 'and');
$location->postType('post', 'and');
$location->postCategory('foobar', 'and');
$location->postTaxonomy('categories', 'and');
$location->postFormat('standard', 'and');
$location->postStatus('publish', 'and');
$location->menu('all', 'and');
$location->menuItem('all', 'and');
$location->widget('all', 'and');
$location->userRole('administrator', 'and');
$location->options('acf-options-common', 'and');
$location->build();
```

#### Repeater Group
```php
$repeater->layout('block'); // block | table | row
$repeater->blockLayout();
$repeater->tableLayout();
$repeater->rowLayout();
$repeater->button('Add a row');
$repeater->min(3); // default to 0
$repeater->max(9); // default to 0 (infinity)
```

#### AbstractField

Every field inherit from `AbstractField` class that provide generic API. Example below works with all fields :

```php
$group->text(/* ... */)->default('Here is a default value');
$group->text(/* ... */)->instructions('Here is an instruction message');
$group->text(/* ... */)->required(); // pass `false` to not required
$group->text(/* ... */)->notRequired();
$group->text(/* ... */)->wrapper(460, '.foo .bar', 'random-id');
$group->text(/* ... */)->wrapperWidth(460);
$group->text(/* ... */)->wrapperClass('.foo .bar');
$group->text(/* ... */)->wrapperId('random-id');
$group->text(/* ... */)->showIf('key', '=', 'value', 'and');
$group->text(/* ... */)->andShowIf('key', '=', 'value');
$group->text(/* ... */)->orShowIf('key', '=', 'value');
$group->text(/* ... */)->onLoad( function ( $field ) { ... } );
$group->text(/* ... */)->onValue( function ( $field ) { ... } );
$group->text(/* ... */)->onUpdate( function ( $field ) { ... } );
$group->text(/* ... */)->onFormat( function ( $field ) { ... } );
$group->text(/* ... */)->toArray();
```

#### AccordionField
```php
$group->accordion(/* ... */)->open(); // pass `false` to close
$group->accordion(/* ... */)->close();
$group->accordion(/* ... */)->multiExpand(); // pass `false` to do not multi expand
$group->accordion(/* ... */)->dontMultiExpand();
```

#### BooleanField
```php
$group->boolean(/* ... */)->message('Here is an informative message');
```

#### ButtonGroupField
```php
$group->buttonGroup(/* ... */)->choices( ['red' => 'Rouge', 'green' => 'Vert', 'blue' => 'Bleu'] );
$group->buttonGroup(/* ... */)->nullable(); // pass `false` to set not nullable
$group->buttonGroup(/* ... */)->notNullable();
$group->buttonGroup(/* ... */)->layout('vertical'); // vertical | horizontal
$group->buttonGroup(/* ... */)->vertical();
$group->buttonGroup(/* ... */)->horizontal();
```

#### CheckboxField
```php
$group->checkbox(/* ... */)->choices( ['red' => 'Rouge', 'green' => 'Vert', 'blue' => 'Bleu'] );
$group->checkbox(/* ... */)->allowCustom(); // pass `false` to disallow custom
$group->checkbox(/* ... */)->disallowCustom();
$group->checkbox(/* ... */)->saveCustom(); // pass `false` to not save custom
$group->checkbox(/* ... */)->dontSaveCustom();
$group->checkbox(/* ... */)->layout('vertical'); // vertical | horizontal
$group->checkbox(/* ... */)->vertical();
$group->checkbox(/* ... */)->horizontal();
```

#### ColorField
```php
$group->color(/* ... */)->enableOpacity(); // pass `false` to disable opacity
$group->color(/* ... */)->disableOpacity();
$group->color(/* ... */)->return('string'); // array | string
$group->color(/* ... */)->returnArray();
$group->color(/* ... */)->returnString();
```

#### DateField
```php
$group->date(/* ... */)->display('g:i a');
$group->date(/* ... */)->return('Y-m-d');
$group->date(/* ... */)->weekStartsOn(0); // value must be between 0 (sunday) and 6 (saturday)
$group->date(/* ... */)->weekStartsOnMonday();
$group->date(/* ... */)->weekStartsOnTuesday();
$group->date(/* ... */)->weekStartsOnWednesday();
$group->date(/* ... */)->weekStartsOnThursday();
$group->date(/* ... */)->weekStartsOnFriday();
$group->date(/* ... */)->weekStartsOnSaturday();
$group->date(/* ... */)->weekStartsOnSunday();
```

#### DateTimeField
```php
$group->datetime(/* ... */)->display('g:i a');
$group->datetime(/* ... */)->return('Y-m-d H:i:s');
$group->datetime(/* ... */)->weekStartsOn(0); // value must be between 0 (sunday) and 6 (saturday)
$group->datetime(/* ... */)->weekStartsOnMonday();
$group->datetime(/* ... */)->weekStartsOnTuesday();
$group->datetime(/* ... */)->weekStartsOnWednesday();
$group->datetime(/* ... */)->weekStartsOnThursday();
$group->datetime(/* ... */)->weekStartsOnFriday();
$group->datetime(/* ... */)->weekStartsOnSaturday();
$group->datetime(/* ... */)->weekStartsOnSunday();
```

#### EmailField
```php
$group->email(/* ... */)->placeholder('This is placeholder');
$group->email(/* ... */)->append('Append text');
$group->email(/* ... */)->prepend('Prepend text');
```

#### FileField
```php
$group->file(/* ... */)->previewSize('thumbnail');
$group->file(/* ... */)->previewThumbnail();
$group->file(/* ... */)->previewMedium();
$group->file(/* ... */)->previewMediumLarge();
$group->file(/* ... */)->previewLarge();
$group->file(/* ... */)->previewFullSize();
$group->file(/* ... */)->restrictLibrary('all'); // all | uploadedTo
$group->file(/* ... */)->showAll();
$group->file(/* ... */)->onlyUploaded();
$group->file(/* ... */)->mimeTypes('pdf');
$group->file(/* ... */)->minSize(0);
$group->file(/* ... */)->maxSize(1000);
$group->file(/* ... */)->size(0, 1000);
$group->file(/* ... */)->return('array'); // array | url
$group->file(/* ... */)->returnObject();
$group->file(/* ... */)->returnArray();
$group->file(/* ... */)->returnUrl();
```

#### GalleryField
```php
$group->gallery(/* ... */)->minWidth(25);
$group->gallery(/* ... */)->maxWidth(1920);
$group->gallery(/* ... */)->width(25, 1920);
$group->gallery(/* ... */)->minHeight(25);
$group->gallery(/* ... */)->maxHeight(960);
$group->gallery(/* ... */)->height(25, 960);
$group->gallery(/* ... */)->previewSize('thumbnail');
$group->gallery(/* ... */)->previewThumbnail();
$group->gallery(/* ... */)->previewMedium();
$group->gallery(/* ... */)->previewMediumLarge();
$group->gallery(/* ... */)->previewLarge();
$group->gallery(/* ... */)->previewFullSize();
$group->gallery(/* ... */)->restrictLibrary('all'); // all | uploadedTo
$group->gallery(/* ... */)->showAll();
$group->gallery(/* ... */)->onlyUploaded();
$group->gallery(/* ... */)->mimeTypes('jpeg', 'png');
$group->gallery(/* ... */)->minSize(0);
$group->gallery(/* ... */)->maxSize(1000);
$group->gallery(/* ... */)->size(0, 1000);
$group->gallery(/* ... */)->return('array'); // array | url
$group->gallery(/* ... */)->returnObject();
$group->gallery(/* ... */)->returnArray();
$group->gallery(/* ... */)->returnUrl();
$group->gallery(/* ... */)->min(3); // default to 0
$group->gallery(/* ... */)->max(9); // default to 0 (infinity)
$group->gallery(/* ... */)->insertNew('append'); // append | prepend
$group->gallery(/* ... */)->insertAppend();
$group->gallery(/* ... */)->insertPrepend();
```

#### GoogleMapField
```php
$group->googleMap(/* ... */)->latitude(-37.81411);
$group->googleMap(/* ... */)->longitude(144.96328);
$group->googleMap(/* ... */)->coordinates(-37.81411, 144.96328);
$group->googleMap(/* ... */)->zoom(14);
$group->googleMap(/* ... */)->height(400);
```

#### ImageField
```php
$group->image(/* ... */)->minWidth(25);
$group->image(/* ... */)->maxWidth(1920);
$group->image(/* ... */)->width(25, 1920);
$group->image(/* ... */)->minHeight(25);
$group->image(/* ... */)->maxHeight(960);
$group->image(/* ... */)->height(25, 960);
$group->image(/* ... */)->previewSize('thumbnail');
$group->image(/* ... */)->previewThumbnail();
$group->image(/* ... */)->previewMedium();
$group->image(/* ... */)->previewMediumLarge();
$group->image(/* ... */)->previewLarge();
$group->image(/* ... */)->previewFullSize();
$group->image(/* ... */)->restrictLibrary('all'); // all | uploadedTo
$group->image(/* ... */)->showAll();
$group->image(/* ... */)->onlyUploaded();
$group->image(/* ... */)->mimeTypes('jpeg', 'png');
$group->image(/* ... */)->minSize(0);
$group->image(/* ... */)->maxSize(1000);
$group->image(/* ... */)->size(0, 1000);
$group->image(/* ... */)->return('array'); // array | url
$group->image(/* ... */)->returnObject();
$group->image(/* ... */)->returnArray();
$group->image(/* ... */)->returnUrl();
```

#### LinkField
```php
$group->postObject(/* ... */)->return('array'); // array | url
$group->postObject(/* ... */)->returnArray();
$group->postObject(/* ... */)->returnUrl();
```

#### MessageField
```php
$group->message(/* ... */)->message('Here is an informative message');
$group->message(/* ... */)->append('Append text');
$group->message(/* ... */)->prepend('Prepend text');
$group->message(/* ... */)->escapeHtml(); // pass `false` to not escape HTML
$group->message(/* ... */)->dontEscapeHtml();
$group->message(/* ... */)->newLines('wpautop'); // wpautop | br | '' (empty string)
$group->message(/* ... */)->paragraphs();
$group->message(/* ... */)->breakLines();
$group->message(/* ... */)->noFormatting();
```

#### NumberField
```php
$group->number(/* ... */)->placeholder('This is placeholder');
$group->number(/* ... */)->append('Append text');
$group->number(/* ... */)->prepend('Prepend text');
$group->number(/* ... */)->min(3); // default to 0
$group->number(/* ... */)->max(9); // default to 0 (infinity)
$group->number(/* ... */)->step(3); // default to 0
```

#### OEmbedField
```php
$group->oEmbed(/* ... */)->width(400);
$group->oEmbed(/* ... */)->height(800);
$group->oEmbed(/* ... */)->dimension(400, 800);
```

#### PageLinkField
```php
$group->pageLink(/* ... */)->taxonomy( 'categories' );
$group->pageLink(/* ... */)->postType( 'posts' );
$group->pageLink(/* ... */)->nullable(); // pass `false` to set not nullable
$group->pageLink(/* ... */)->notNullable();
$group->pageLink(/* ... */)->multiple(); // pass `false` to set not multiple
$group->pageLink(/* ... */)->notMultiple();
```

#### PasswordField
```php
$group->password(/* ... */)->placeholder('This is placeholder');
$group->password(/* ... */)->append('Append text');
$group->password(/* ... */)->prepend('Prepend text');
```

#### PostObjectField
```php
$group->postObject(/* ... */)->taxonomies( ['categories'] );
$group->postObject(/* ... */)->postsType( ['posts'] );
$group->postObject(/* ... */)->return('object'); // object | id
$group->postObject(/* ... */)->returnObject();
$group->postObject(/* ... */)->returnId();
$group->postObject(/* ... */)->onQuery( function () { ... } ); // check ACF documentation about Post Object field filters 
$group->postObject(/* ... */)->onResult( function () { ... } );
```

#### RadioField
```php
$group->radio(/* ... */)->choices( ['red' => 'Rouge', 'green' => 'Vert', 'blue' => 'Bleu'] );
$group->radio(/* ... */)->allowOtherChoice(); // pass `false` to set disallow other choice
$group->radio(/* ... */)->disallowOtherChoice();
$group->radio(/* ... */)->saveOtherChoice(); // pass `false` to set do not save other choice
$group->radio(/* ... */)->dontSaveOtherChoice();
$group->radio(/* ... */)->layout('vertical'); // vertical | horizontal
$group->radio(/* ... */)->vertical();
$group->radio(/* ... */)->horizontal();
```

#### RangeField
```php
$group->range(/* ... */)->append('Append text');
$group->range(/* ... */)->prepend('Prepend text');
$group->range(/* ... */)->min(3); // default to 0
$group->range(/* ... */)->max(9); // default to 0 (infinity)
$group->range(/* ... */)->step(3); // default to 0
```

#### RelationshipField
```php
$group->relationship(/* ... */)->taxonomies( ['categories'] );
$group->relationship(/* ... */)->postsType( ['posts'] );
$group->relationship(/* ... */)->filters( ['search' => true, 'post_type' => false, 'taxonomy' => false] );
$group->relationship(/* ... */)->filterOnSearch(); // pass `false` to set not filter on search
$group->relationship(/* ... */)->dontFilterOnSearch();
$group->relationship(/* ... */)->filterByPostType(); // pass `false` to set not filter by post type
$group->relationship(/* ... */)->dontFilterByPostType();
$group->relationship(/* ... */)->filterByTaxonomy(); // pass `false` to set not filter by taxonomy
$group->relationship(/* ... */)->dontFilterByTaxonomy();
$group->relationship(/* ... */)->return('object'); // object | id
$group->relationship(/* ... */)->returnObject();
$group->relationship(/* ... */)->returnId();
$group->relationship(/* ... */)->onQuery( function () { ... } ); // check ACF documentation about relationship field filters 
$group->relationship(/* ... */)->onResult( function () { ... } );
$group->relationship(/* ... */)->min(3); // default to 0
$group->relationship(/* ... */)->max(9); // default to 0 (infinity)
```

#### SelectField
```php
$group->select(/* ... */)->choices( ['red' => 'Rouge', 'green' => 'Vert', 'blue' => 'Bleu'] );
$group->select(/* ... */)->placeholder('This is placeholder');
$group->select(/* ... */)->nullable(); // pass `false` to set not nullable
$group->select(/* ... */)->notNullable();
$group->select(/* ... */)->multiple(); // pass `false` to set not multiple
$group->select(/* ... */)->notMultiple();
$group->select(/* ... */)->ui('default'); // default | select2
$group->select(/* ... */)->defaultUi();
$group->select(/* ... */)->select2Ui();
$group->select(/* ... */)->useAjax(); // pass `false` to not use ajax
$group->select(/* ... */)->dontUseAjax();
```

#### TabField
```php
$group->tab(/* ... */)->placeholder('top'); // top | left
$group->tab(/* ... */)->topAligned();
$group->tab(/* ... */)->leftAligned();
```

#### TaxonomyField
```php
$group->taxonomy(/* ... */)->which('category');
$group->taxonomy(/* ... */)->appearance('checkbox'); // checkbox || multi_select || radio || select
$group->taxonomy(/* ... */)->asCheckbox();
$group->taxonomy(/* ... */)->asMultiSelect();
$group->taxonomy(/* ... */)->asRadio();
$group->taxonomy(/* ... */)->asSelect();
$group->taxonomy(/* ... */)->saveTerms(); // pass `false` to not save terms
$group->taxonomy(/* ... */)->dontSaveTerms();
$group->taxonomy(/* ... */)->return();
$group->taxonomy(/* ... */)->returnObject();
$group->taxonomy(/* ... */)->returnId();
$group->taxonomy(/* ... */)->allowAddTerm(); // pass `false` to disallow add term
$group->taxonomy(/* ... */)->disallowAddTerm();
$group->taxonomy(/* ... */)->onQuery( function () { ... } ); // check ACF documentation about taxonomy field filters 
$group->taxonomy(/* ... */)->onResult( function () { ... } );
```

#### TextareaField
```php
$group->textarea(/* ... */)->placeholder('This is placeholder');
$group->textarea(/* ... */)->append('Append text');
$group->textarea(/* ... */)->prepend('Prepend text');
$group->textarea(/* ... */)->readOnly(); // pass `false` to set not read only
$group->textarea(/* ... */)->notReadOnly();
$group->textarea(/* ... */)->disable(); // pass `false` to enable
$group->textarea(/* ... */)->enable();
$group->textarea(/* ... */)->maxLength(50);
$group->textarea(/* ... */)->rows(10);
$group->textarea(/* ... */)->rows(10);
$group->textarea(/* ... */)->newLines('wpautop'); // wpautop | br | '' (empty string)
$group->textarea(/* ... */)->paragraphs();
$group->textarea(/* ... */)->breakLines();
$group->textarea(/* ... */)->noFormatting();
```

#### TextField
```php
$group->text(/* ... */)->placeholder('This is placeholder');
$group->text(/* ... */)->append('Append text');
$group->text(/* ... */)->prepend('Prepend text');
$group->text(/* ... */)->readOnly(); // pass `false` to set not read only
$group->text(/* ... */)->notReadOnly();
$group->text(/* ... */)->disable(); // pass `false` to enable
$group->text(/* ... */)->enable();
$group->text(/* ... */)->maxLength(50);
```

#### TimeField
```php
$group->time(/* ... */)->display('g:i a');
$group->time(/* ... */)->return('Y-m-d H:i:s');
```

#### UrlField
```php
$group->url(/* ... */)->placeholder('This is placeholder');
```

#### UserField
```php
$group->user(/* ... */)->nullable(); // pass `false` to set not nullable
$group->user(/* ... */)->notNullable();
$group->user(/* ... */)->multiple(); // pass `false` to set not multiple
$group->user(/* ... */)->notMultiple();
$group->user(/* ... */)->roles(['administrator', 'editor']); // array of roles
```

#### WysiwygField
```php
$group->wysiwyg(/* ... */)->tabs('all'); // all | visual | text
$group->wysiwyg(/* ... */)->allTabs();
$group->wysiwyg(/* ... */)->visualOnly();
$group->wysiwyg(/* ... */)->textOnly();
$group->wysiwyg(/* ... */)->toolbar('full'); // full | basic
$group->wysiwyg(/* ... */)->fullToolbar();
$group->wysiwyg(/* ... */)->basicToolbar();
$group->wysiwyg(/* ... */)->showMediaButton(); // pass `false` to hide media button
$group->wysiwyg(/* ... */)->hideMediaButton();
```

#### Generic methods

Both fields and groups can use these methods:

```php
$field->toArray();
$field->toJson();
$field->dd();
```

### Requirement

PHP 8.0 or above