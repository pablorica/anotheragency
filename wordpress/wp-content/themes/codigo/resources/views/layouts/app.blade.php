<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php(do_action('get_header'))
    @php(wp_head())

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <?php
  //Check if body_class() contains wp-admin
  $body_class_frontend = 'overflow-x-hidden';
  $body_class = esc_attr( implode( ' ', get_body_class() ) );
  if (strpos($body_class, 'wp-admin') === false) {
    $body_class_frontend .= ' wp-frontend';
  }
  ?>

  <body @php(body_class($body_class_frontend))>
    @php(wp_body_open())
{{--
    mb-auto
    xl:!border-b-0 !border-r-0 xl:!border-r-[1px]
    max-w-[260px] max-w-[280px] 2xl:max-w-full
    bg-contain bg-cover
--}}

<div id="app">
  <a class="sr-only focus:not-sr-only" href="#main">
    {{ __('Skip to content', 'sage') }}
  </a>

  @include('sections.header')

    <main
      id="main"
      class="main
        @if( get_field('mobile_bigheaderfooter',get_the_ID()) ) mb-0 @endif
        @if( get_field('pagination',get_the_ID()) ) relative @endif
      "
    >
      @yield('content')
    </main>

    @hasSection('sidebar')
      <aside class="sidebar @option('header_layout_container')">
        @yield('sidebar')
      </aside>
    @endif

  @include('sections.footer')
</div>

@php(do_action('get_footer'))
@php(wp_footer())
</body>
</html>
