<template>
  <q-page class="q-pa-lg">
    <h2 class="q-mt-none q-header--bordered">Modules</h2>
    <h4>Enable or disable entire modules here.</h4>

    <q-list bordered separator>
      <q-item class="q-pa-md justify-start " v-for="module in store.modules" :key="module.details.id">
        <q-item-section class="col-auto"  style="align-self: start" >
          <q-toggle
            v-model="module.enabled"
            color="green"
            @click="handleSwitchChange(module)"
            :disable="!module.details.can_disable"
          />
        </q-item-section>
        <q-item-section style="align-self: start" >
          <q-item-label>{{ module.details.name }} <small v-if="!module.details.can_disable">(Module cannot be
            disabled)</small></q-item-label>
          <q-item-label caption>{{ module.details.description }}</q-item-label>
          <q-item-label caption v-if="store.hasDocumentation(module)"><a :href="module.details.documentation_uri" target="_blank">Documentation</a></q-item-label>
        </q-item-section>
        <q-item-section >
          <q-item-label header>Attributions:</q-item-label>
            <q-list>
              <q-item-section>
                <q-item v-for="(item,index) in module.details.attributions " :key="index" class="flex column">
                  <q-item-label caption>{{item.name}} ({{item.company}}) <img :src="item.logo" class="logo"></q-item-label>
                  <q-item-label caption>{{item.comment}}</q-item-label>
                  <q-item-label caption><a :href="item.tutorial_uri" target="_blank">Original Tutorial</a> </q-item-label>
                </q-item>
              </q-item-section>
            </q-list>
        </q-item-section>
      </q-item>
    </q-list>
    <q-inner-loading
      label="Please wait..."
      label-class="text-teal"
      label-style="font-size: 1.1em"
      :showing="store.fetching"
    />
  </q-page>
</template>

<script>
import {defineComponent} from 'vue'
import {useModuleStore} from "stores/modules-store";
const store = useModuleStore();

export default defineComponent({
  name: 'ModulesPage',
  setup() {
    return {
      store: store
    }
  },
  mounted() {
    this.store.fetchAll();
  },
  methods: {
    handleSwitchChange(module) {
      this.store.updateModuleState(module)
    }
  },

})
</script>

<style scoped >
.logo{
  height: 16px;
  width: auto;
}
</style>
