//https://www.advancedcustomfields.com/resources/javascript-api/#filters-color_picker_args


  acf.add_filter('color_picker_args', function (args, $field) {
    /* Colours (must match with resources/css/base.css ) */
    args.palettes = [
      'var(--color-black)',
      'var(--color-white)',
      'var(--color-chalk)',
      'var(--color-charcoal)',
      'var(--color-char)',
      'var(--color-walnut)',
      'var(--color-citrus)',
      'var(--color-sage)',
      'var(--color-teal)',
      'var(--color-lilac)',
      'var(--color-gray)',
      'var(--color-lightgray)',
      'var(--color-border)'
    ]
    return args;
  });

