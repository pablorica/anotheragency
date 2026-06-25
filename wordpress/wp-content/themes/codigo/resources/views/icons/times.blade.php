{{--
  @name Times icon
  @param svg_width The width of the SVG. Defaults to 54.
  @param svg_height The height of the SVG. Defaults to 54.
  @param svg_class Additional classes for the SVG element.
  @param polygon_class Additional classes for the polygon elements.
  @desc An times icon that can be used for navigation links.

  Example
    @include(
      'icons.times',
      [
        'svg_width' => 16,
        'svg_height' => 16,
        'svg_class' => 'mx-4',
      ]
    )
--}}

<!-- /views/icons/times.blade.php -->
<svg
  width="{{ $svg_width ?? 50 }}"
  height="{{ $svg_height ?? 50 }}"
  class="{{ $svg_class ?? '' }}"
  viewBox="0 0 50 50"
  xmlns="http://www.w3.org/2000/svg"
>
  <circle cx="25" cy="25" r="22" stroke="black" stroke-width="1.5" fill="none"></circle>
  <line x1="25" y1="10" x2="25" y2="40" stroke="black" stroke-width="1.5"></line>
  <line x1="10" y1="25" x2="40" y2="25" stroke="black" stroke-width="1.5"></line>
</svg>
<!-- End /views/icons/times.blade.php -->
