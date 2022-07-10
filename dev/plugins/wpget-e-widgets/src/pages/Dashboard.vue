<template>
  <q-page class="q-pa-lg">
    <h2 class="q-mt-none q-header--bordered">Dashboard</h2>
    <div class="">
      <h3 >About</h3>
      <p>
        This project is a collaboration between Element How and WPGet.
      </p>
      <p>
        Elementor has a great framework for extending features, widgets and functionality. However, it is often difficult to find accurate documentation. This project has been created from our experiences, learning how to extend Elementor.
      </p>
      <p>
        All code is readable, there will be no minification or uglifying of any code. For JavaScript we use ES6 syntax which is compatible with modern browsers. Most recommendations are to transpile eo ES5 (ES2005) for Browser compatability. We don't feel that is necessary any more. see https://caniuse.com/?search=es6
      </p>
    </div>
    <h3>Attributions</h3>
    <h5>
      This dashboard is built with.
    </h5>
    <ul>
      <li>Vuejs 3 - https://vuejs.org/</li>
      <li>Quasar - https://quasar.dev/</li>
    </ul>
    <h5>
      Elementor Widjets.
    </h5>
    <ul>
      <li>Inspiration and code for Widgets: Element How - https://element.how/</li>
      <li>Translating Code into Elementor Widgets: WPGet - https://www.wpget.au/</li>
    </ul>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'IndexPage'
})
</script>
