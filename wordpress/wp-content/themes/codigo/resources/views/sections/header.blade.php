{{--
    @name Header
    @desc The sites header rendered on each page.
--}}
<!-- /resources/views/sections/header.blade.php -->
<header
  id="mainMenu"
  x-data="menuCollapse"
  class="banner w-full
    sticky top-0 z-50
    bg-chalk lg:bg-opacity-0
    {{ get_field('fixed_header') || is_singular('collaborator') ? 'lg:fixed lg:top-0 lg:w-auto' : 'lg:static' }}"
>
  <nav
    class="nav-primary @option('header_layout_container') py-5 relative"
    aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}"
  >
    <div class="flex flex-wrap items-center justify-between w-full lg:w-auto">
      @if (is_front_page())
        {{-- Animation Brand --}}
        <div class="splash-logo splash-logo--header">
          <a
            href="{{ home_url('/') }}"
            class="brand-header
            text-7xl md:text-8xl 2xl:text-9xl
            text-charcoal leading-[0.75]"
          >
            <span class="@if( get_field('mobile_bigheaderfooter',get_the_ID()) ) block  @else hidden md:block  @endif"
            >{{ __('Canvas', 'codigo') }}</span>
          </a>
        </div>
        {{-- End Animated Brand --}}
      @endif
      <a
        href="{{ home_url('/') }}"
        class="brand-header
        text-7xl md:text-8xl 2xl:text-9xl
        text-charcoal leading-[0.75]"
      >
        <span class="
          @if( get_field('mobile_bigheaderfooter',get_the_ID()) ) block @else hidden md:block  @endif"
        >{{ __('Canvas', 'codigo') }}</span>
        <span class="h-[56px]
        @if( get_field('mobile_bigheaderfooter',get_the_ID()) ) hidden @else block md:hidden  @endif">
          @include(
            'icons.logo',
            [
              'svg_width' => 1000,
              'svg_height' => 430.4,
              'svg_class' => 'h-full',
              'path_class' => 'fill-charcoal',
            ]
          )
        </span>
      </a>
      <button
        aria-label="Toggle Menu"
        class="toggle-button
          collaborator-fade-in-up
          px-2 py-1 ml-auto md:hidden"
        aria-expanded="false"
        :class="{ 'rotate transform rotate-45': menuCollapse }"
        @click="toggleMenu"
      >
        <div class="transition-transform duration-300"
          :class="{ 'rotate transform rotate-45': menuCollapse }"
        >
          @include(
            'icons.times',
            [
              'svg_width' => 35,
              'svg_height' => 35,
            ]
          )
        </div>
      </button>
    </div>

    <ul
      class="grid list-none mt-6
        w-full md:max-w-[300px] 2xl:max-w-[400px]
        grid-cols-2 gap-2 md:z-10 relative
      {{ get_field('fixed_header') ? 'md:min-w-[300px] 2xl:min-w-[400px]' : '' }}"
    >
      @php($menu_items = wp_get_nav_menu_items('Jobs Filters Menu'))

      @foreach($menu_items as $item)
        <li>
          <a
            href="{{ $item->url }}"
            class="block
              leading-none text-center
            ">
            <span data-title="{{ $item->title }}"
              class="button-menu growing-button
                text-md md:text-sm 2xl:text-base
                py-2 px-5 md:py-[5px] md:px-[8px] 2xl:py-2 2xl:px-5
                rounded-full
                bg-chalk hover:bg-citrus
                transition-colors duration-300
                overflow-ellipsis overflow-hidden whitespace-nowrap
                border border-charcoal inline-block
                {{ $item->object_id == get_the_ID() ? '!bg-charcoal !text-chalk' : 'text-charcoal' }}
            ">{{ $item->title }}</span>
          </a>
        </li>
      @endforeach
    </ul>

    @if(is_page_template('template-jobs.blade.php'))
      @include('partials.jobs-tags')
    @endif

    <div
      class="fixed inset-0 mobile-menu bg-charcoal animate-appearsmenu"
      x-show="menuCollapse"
    >
     @include('partials.mobile-menu')
    </div>
  </nav>
</header>

<!-- End /resources/views/sections/header.blade.php -->