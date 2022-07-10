import { defineStore } from 'pinia'

export const useModuleStore = defineStore('modules-store', {
  state: () => ({
    modules: [],
    fetching: false
  }),

  getters: {

  },

  actions: {
    hasDocumentation(module){
      return module.details.documentation_uri !== undefined && module.details.documentation_uri !== '';
    },

    fetchAll () {
      this.modules = [
        {
          details: {
            id: "remote_connectors",
            can_disable: false,
            name: 'Remote Connectors',
            description: 'Various Widgets which connect other widgets',
            documentation_uri: 'https://plugins.wpget.net/plugins/wpget-elementor-widgets/remote_connectors/',
            attributions: [
              {
                name: "Alan Blair",
                company: 'WPGet',
                logo: "https://www.wpget.au/wp-content/uploads/2020/09/logo-alt@2x.png",
                comment: "Original code from a Tutorial",
                tutorial_uri: "https://www.wpget.au/tutorial/elementor-image-transition-to-header/"
              }
            ],
            dependencies: ['Elementor'],
          },
          enabled: true, // get from module state

          widgets: [
            {
              details: {
                id: 'test_widget',
                can_disable: true,
                name: 'Test Widget',
                description: 'Test Widget Description',
                documentation_uri: 'https://plugins.wpget.net/plugins/wpget-elementor-widgets/remote_connectors/',
              },
              enabled: true
            }
          ]

        },
        {
          details: {
            id: "ehow_reveals",
            can_disable: true,
            name: 'Elementor How Reveals',
            description: 'Various Widgets to hide/show content',

            attributions: [
              {
                name: "Maxime",
                company: 'Element How',
                logo: "https://cdn.element.how/wp-content/uploads/2021/01/elementhow.svg",
                comment: "Original code from Element How Tutorial",
                tutorial_uri: "https://www.wpget.au/tutorial/elementor-image-transition-to-header/"
              }
            ],
            dependencies: ['Elementor Pro', 'Crockoblock JetEngine'],
          },

          enabled: true, // get from module state
          widgets: []
        },
      ]
    },

    fetchModule(id){

    },

    updateModuleState(module){
      console.log('UPDATE:', module)
    }
  }
})
