<p align="center">
  <a href="https://roots.io/sage/"><img alt="Sage" src="https://cdn.roots.io/app/uploads/logo-sage.svg" height="100"></a>
</p>

<p align="center">
  <a href="https://packagist.org/packages/roots/sage"><img alt="Packagist Installs" src="https://img.shields.io/packagist/dt/roots/sage?label=projects%20created&colorB=2b3072&colorA=525ddc&style=flat-square"></a>
  <a href="https://github.com/roots/sage/actions/workflows/main.yml"><img alt="Build Status" src="https://img.shields.io/github/actions/workflow/status/roots/sage/main.yml?branch=main&logo=github&label=CI&style=flat-square"></a>
  <a href="https://twitter.com/rootswp"><img alt="Follow Roots" src="https://img.shields.io/badge/follow%20@rootswp-1da1f2?logo=twitter&logoColor=ffffff&message=&style=flat-square"></a>
  <a href="https://github.com/sponsors/roots"><img src="https://img.shields.io/badge/sponsor%20roots-525ddc?logo=github&style=flat-square&logoColor=ffffff&message=" alt="Sponsor Roots"></a>
</p>

# Sage

**Advanced hybrid WordPress starter theme with Laravel Blade and Tailwind CSS**

- 🔧 Clean, efficient theme templating with Laravel Blade
- ⚡️ Modern front-end development workflow powered by Vite
- 🎨 Out of the box support for Tailwind CSS
- 🚀 Harness the power of Laravel with [Acorn integration](https://github.com/roots/acorn)
- 📦 Block editor support built-in

Sage brings proper PHP templating and modern JavaScript tooling to WordPress themes. Write organized, component-based code using Laravel Blade, enjoy instant builds and CSS hot-reloading with Vite, and leverage Laravel's robust feature set through Acorn.

[Read the docs to get started](https://roots.io/sage/docs/installation/)



---


## SAGE Tools

### Installing ACF Composer

ACF Composer is the ultimate tool for creating fields, blocks, widgets, and option pages using ACF Builder alongside Sage 10.

See the [ACF Composer installation](https://github.com/Log1x/acf-composer?tab=readme-ov-file#installation).


#### Install via Composer:

```bash
cd wordpress/wp-content/themes/codigo
composer require log1x/acf-composer
```

Start by publishing the `config/acf.php` configuration file using Acorn:

```bash
docker compose run wpcli acorn vendor:publish --tag="acf-composer"
```


If you have this warning

```bash
INFO No publishable resources for tag [acf-composer].
```

try running this command first

```bash
docker compose run wpcli acorn package:discover
INFO  Discovering packages.  
nesbot/carbon ......................................................... DONE
nunomaduro/termwind ................................................... DONE
roots/sage ............................................................ DONE
```

And try again:

```bash
docker compose run wpcli acorn vendor:publish --tag="acf-composer"
INFO  Publishing [acf-composer] assets.
Copying file [vendor/log1x/acf-composer/config/acf.php] to [config/acf.php] ............. DONE
```

##### Generating a Field Group

To create your first field group, start by running the following generator command from your theme directory:   

```bash
docker compose run wpcli acorn acf:field Example
```

This will create `app/Fields/Example.php` which is where you will create and manage your first field group.

##### Generating a Field Partial

A field partial consists of a field group that can be re-used and/or added to existing field groups.

```bash
docker compose run wpcli acorn acf:partial ContainerButtons
```
This will create `app/Fields/Partials/ListItems.php`.

This can be utilized in our `Example` field by passing the `::class` constant to `->addPartial()`

```php
->addPartial(ContainerButtons::class);
```

##### Generating a Option Group
Option pages are a great way to create global settings for your theme. To create an option page, run the following command:

```bash
docker compose run wpcli acorn acf:option Example
```
This will create `app/Options/Example.php` which is where you will create and manage your first option page.

##### Generating a Block

Generating a block is generally the same as generating a field as seen above.

Start by creating the block field using Acorn:

```bash
docker compose run wpcli acorn acf:block Example
    
🎉 Example block successfully composed.
  ⮑  app/Blocks/Example.php
  ⮑  resources/views/blocks/example.blade.php
```

You may also pass --construct to the command above to generate a stub with the block properties set within an attributes method. This can be useful for localization, etc.

```bash
docker compose run wpcli acorn acf:block Example --construct
```

When running the block generator, one difference to a generic field is an accompanied View is generated in the resources/views/blocks directory.

Like the field generator, the example block contains a simple list repeater and is working out of the box.

*Block Preview View*

While `$block->preview` is an option for conditionally modifying your block when shown in the editor, you may also render your block using a seperate view.

Simply duplicate your existing view prefixing it with `preview-` (e.g. `preview-example.blade.php`).


### Poet

```bash
cd wordpress/wp-content/themes/codigo
composer require log1x/poet
```

Start with publishing the Poet configuration file using Acorn:

```bash
docker compose run wpcli acorn vendor:publish --provider="Log1x\Poet\PoetServiceProvider"
...
  Copying file [vendor/log1x/poet/config/poet.php] to [config/poet.php] ..... DONE
```

### Registering a Post Type

All configuration related to Poet is located in `config/poet.php`. Here you will find an example Book post type pre-configured with a few common settings:

```php
    'post' => [
        'book' => [
            'enter_title_here' => 'Enter book title',
            'menu_icon' => 'dashicons-book-alt',
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => false,
            'labels' => [
                'singular' => 'Book',
                'plural' => 'Books',
            ],
        ],
    ],
```


### Sage directives

[Sage Directives](https://log1x.github.io/sage-directives-docs/) adds a variety of useful Blade directives for use with Sage 10 including directives for WordPress, ACF, and various miscellaneous helpers.



#### Install Sage directives

```bash
cd wordpress/wp-content/themes/codigo
composer require log1x/sage-directives
```

#### Sage directives Examples

[Wordpress](https://log1x.github.io/sage-directives-docs/usage/wordpress.html)

**`WP_Query`**

`@query` initializes a standard `WP_Query` as `$query` and accepts the usual `WP_Query` parameters as an array.

```blade
@query([
  'post_type' => 'post'
])

@posts
  <h2  class="entry-title">@title</h2>
  <div  class="entry-content">
    @content
  </div>
@endposts
```

[ACF](https://log1x.github.io/sage-directives-docs/usage/acf.html)

**`@field`**


`@field` echoes the specified field using `get_field()`.

```blade
@field('text')
```


**`@option`**


`@option` echoes the specified theme options field using ` get_field($field, 'option')`.

```blade
@option('text')
```

### SAGE commands

Clear cache

```bash
docker compose run wpcli acorn optimize:clear
docker compose exec app php artisan view:clear
```

php artisan view:clear

---







## Support us

Roots is an independent open source org, supported only by developers like you. Your sponsorship funds [WP Packages](https://wp-packages.org/) and the entire Roots ecosystem, and keeps them independent. Support us by purchasing [Radicle](https://roots.io/radicle/) or [sponsoring us on GitHub](https://github.com/sponsors/roots) — sponsors get access to our private Discord.

### Sponsors

<a href="https://carrot.com/"><img src="https://cdn.roots.io/app/uploads/carrot.svg" alt="Carrot" height="90"></a> <a href="https://wordpress.com/"><img src="https://cdn.roots.io/app/uploads/wordpress.svg" alt="WordPress.com" height="90"></a> <a href="https://www.itineris.co.uk/"><img src="https://cdn.roots.io/app/uploads/itineris.svg" alt="Itineris" height="90"></a> <a href="https://kinsta.com/?kaid=OFDHAJIXUDIV"><img src="https://cdn.roots.io/app/uploads/kinsta.svg" alt="Kinsta" height="90"></a> <a href="https://40q.agency/"><img src="https://cdn.roots.io/app/uploads/40q.svg" alt="40Q" height="90"></a>

## Community

Keep track of development and community news.

- Join us on Discord by [sponsoring us on GitHub](https://github.com/sponsors/roots)
- Join us on [Roots Discourse](https://discourse.roots.io/)
- Follow [@rootswp on Twitter](https://twitter.com/rootswp)
- Follow the [Roots Blog](https://roots.io/blog/)
- Subscribe to the [Roots Newsletter](https://roots.io/subscribe/)
