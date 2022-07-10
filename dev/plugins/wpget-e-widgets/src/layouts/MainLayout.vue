<template>
  <q-layout view="lHh Lpr lFf">
    <q-header>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>
          WPGet Widgets <small>v{{ $q.version }} {{ todaysDate }}</small>
        </q-toolbar-title>

      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      :width="200"
      :breakpoint="600"
    >
      <q-scroll-area style="height: calc(100% - 150px); margin-top: 150px; border-right: 1px solid #ddd">
        <q-list padding>
          <q-item
            clickable
            v-ripple
            to="/"
            exact
          >
            <q-item-section avatar>
              <q-icon name="dashboard"/>
            </q-item-section>

            <q-item-section
              clickable
              v-ripple
            >
              Dashboard
            </q-item-section>
          </q-item>

          <q-item
            clickable
            v-ripple
            to="/modules"
            exact
          >
            <q-item-section avatar>
              <q-icon name="view_module"/>
            </q-item-section>

            <q-item-section>
              Modules
            </q-item-section>
          </q-item>

          <q-item
            clickable
            v-ripple
            to="/widgets"
            exact
          >
            <q-item-section avatar>
              <q-icon name="widgets"/>
            </q-item-section>

            <q-item-section>
              Widgets
            </q-item-section>
          </q-item>
        </q-list>
      </q-scroll-area>

      <q-img class="absolute-top" src="https://cdn.quasar.dev/img/material.png" style="height: 150px" >
        <div class="absolute-bottom bg-transparent">
          <q-avatar size="56px" class="q-mb-sm">
            <img src="https://cdn.quasar.dev/img/boy-avatar.png" alt=""/>
          </q-avatar>
          <div class="text-weight-bold">Alan Blair</div>
          <div>alan@wpget.au</div>
        </div>
      </q-img>
    </q-drawer>

    <q-page-container>
      <router-view/>
    </q-page-container>
  </q-layout>
</template>

<script>
import {defineComponent, ref} from 'vue'
import {date} from 'quasar'



export default defineComponent({
  name: 'MainLayout',

  components: {},

  computed: {
    todaysDate() {
      const timeStamp = Date.now()
      return date.formatDate(timeStamp, 'DD/MM/YYYY')
    }
  },

  setup() {
    const leftDrawerOpen = ref(false)

    return {
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value
      }
    }
  }
})
</script>

