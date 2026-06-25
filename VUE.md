
# VUE


#### 1. **Install Vue and the Vue plugin for Vite**

In your project root, run:

```bash
npm install vue
npm install -D @vitejs/plugin-vue

## If Docker is used, run the following command inside the Node container:
docker compose run --rm node sh -lc "npm install vue"
docker compose run --rm node sh -lc "npm install -D @vitejs/plugin-vue"
```


#### 2. **Update your `vite.config.js` to use the Vue plugin**

```js
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue' // ← Add this line

export default defineConfig({
  base: '/wp-content/themes/codigo/public/build/',
  plugins: [
    vue(), // ← Add this line
    tailwindcss(),
    ...
  ]
})
```


#### 3. **Create a Vue component and mount it**

Example: `resources/js/app.js` or wherever you're booting your JavaScript:

```js
import { createApp } from 'vue'
import Example from './vuecomponents/Example.vue';


if (document.getElementById("vueExample")) {
  const app = createApp(Example);
  app.mount('#vueExample');
}

```

Make sure you have a root element in your Blade or HTML file like:

```html
<div id="vueExample"></div>
```


#### 4. **Add a Vue component**

Create a file like `resources/js/vuecomponents/Example.vue`:

```vue
<template>
  <div>Hello from Vue!</div>
</template>

<script>
export default {
  name: 'Example'
}
</script>
```

#### 5. Run the dev server

Back in your theme folder:

```bash
npm run dev

## Or if Docker is used, run the following command inside the Node container:
docker compose run --rm node sh -lc "npm run dev"
```

You should see “Hello from Vue!” rendered in your theme!


## Uninstall Vue

If you no longer need Vue in your Sage project, remove it by following these steps:

**1. Uninstall the packages**

```bash
npm uninstall vue @vitejs/plugin-vue

## If Docker is used, run the following commands inside the Node container:
docker compose run --rm node sh -lc "npm uninstall vue @vitejs/plugin-vue"
```

**2. Remove the Vue plugin from `vite.config.js`**

Delete the Vue import:

```js
import vue from '@vitejs/plugin-vue'
```

And remove the plugin from the `plugins` array:

```js
plugins: [
  tailwindcss(),
  ...
]
```

**3. Remove Vue initialization**

Delete any Vue-related imports and mounting code from your JavaScript entry file (for example, `resources/js/app.js`):

```js
import { createApp } from 'vue'
import Example from './vuecomponents/Example.vue';

if (document.getElementById("vueExample")) {
  const app = createApp(Example);
  app.mount('#vueExample');
}
```

**4. Remove Vue components**

Delete any `.vue` component files (for example, `resources/js/vuecomponents/`) if they are no longer needed.

**5. Remove Vue mount points**

Remove any Vue root elements from your Blade templates or HTML, for example:

```html
<div id="vueExample"></div>
```

**6. Restart the development server**

```bash
npm run dev

## Or if Docker is used, run the following command inside the Node container:
docker compose run --rm node sh -lc "npm run dev"
```

Your Sage project will now run without Vue.
