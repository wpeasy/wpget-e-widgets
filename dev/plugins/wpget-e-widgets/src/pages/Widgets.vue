<template>
  <q-page class="q-pa-lg">
    <h2 class="q-mt-none q-header--bordered">Widgets</h2>

    <div v-for="module in enabledModules" :key="module.details.id">
      <h4>{{ module.details.name }}</h4>


      <div class="q-pa-md row items-start q-gutter-md">
        <q-card v-for="widget in module.widgets" :key="widget.details.id" class="my-card" >
          <q-card-section class="bg-blue text-white">
            <div class="text-h6">{{widget.details.name}}e</div>
            <div class="text-subtitle2">{{ widget.details.description }}</div>
            <div class="text-subtitle2">By:</div>
            <div class="text-subtitle2">By:</div>
          </q-card-section>

          <q-separator/>

          <q-card-actions align="left">
            <q-toggle v-model="widget.enabled"/>
          </q-card-actions>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import {defineComponent} from 'vue'
import {useModuleStore} from 'stores/modules-store'
export default defineComponent({
  name: 'ModulesPage',
  setup() {
    const store = useModuleStore();
    return {
      store
    }
  },

  computed: {
    enabledModules(){
      return this.store.modules.filter( item =>{
        return item.enabled === true;
      })
    }
  },
  mounted() {

  }
})
</script>

<style scoped >
.my-card{
  max-width: 300px;
  width: 100%;
}
</style>
