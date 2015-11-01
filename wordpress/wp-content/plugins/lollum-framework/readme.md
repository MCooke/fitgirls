===Lollum Framework===

Contributors: Lollum (lollum.com)
Version 1.6
Requires at least: 3.4.0
Tested up to: 3.8.1

==Description==

Lollum Framework extends functionality to Lollum themes. It provides some post types, the page builder, shortcodes, post formats meta boxes and the 'love' functionality.

==Frequently Asked Questions==

= What is this plugin and why do I need it? =

Lollum Framework provides extra functionality to the collection of Lollum themes. The plugin is not a requirement to use Lollum themes, but it will extend the themes to function as you see them in the demos.

= Can I use this plugin with other themes? =

Lollum Framework was developed to extend the functionality of Lollum themes specifically, however parts of it may be useful to other themes. If using your own theme, you may have to provide some extra styling or modifications to customize it to your needs.

To register a post type add this code in your theme (functions.php):

```php
$post_types = array(
	'portfolio' => 'yes',
	'team' => 'yes',
	'job' => 'yes',
	'faq' => 'yes'
);
add_option('lolfmk_supported_post_types', $post_types);
```

Please note: I don't provide support for these customizations.

==Changelog==

= v1.6 - Feb 11, 2013 =
* New blocks and some options for Big Point

= v1.5 - Jan 21, 2013 =
* Filter FAQs by category.
* Marker in Map Block.
* Lightbox in Image Block.
* Minor fix.

= v1.4 - Dec 20, 2013 =
* Minor fix.

= v1.3 - Dec 01, 2013 =
* Version fixed.

= v1.2 - Nov 28, 2013 =
* Added post types support control.
* Fixed minor error in feature block

= v1.1 - Nov 09, 2013 =
* Added product sidebar option.

= v1.0 - Oct 30, 2013 =
* Original Release.