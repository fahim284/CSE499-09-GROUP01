var token = document.head.querySelector('meta[name="csrf-token"]');
axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

var app = new Vue({
  el: '#app',
  data: function () {
    return {
      env: [],
      redprint: [],
      permissible: [],
      theme: [],
      saving: false,
      loading: true,
    }
  },
  computed: {

  },
  mounted: function () {
    this.loadEnvContent()
    this.loadRedprintConfig()
    this.loadPermissibleConfig()
    this.loadThemeConfig()
  },
  methods:{
    load: function (route, container) {
      var self = this
      self.loading = true
      axios.get(route)
        .then(function (response) {
          self[container] = response.data
          self.loading = false
        })
        .catch(function (response) {
          self.loading = false
          console.log(JSON.stringify(response))
        })
    },
    save: function (route, data) {
      var self = this
      if(window.redprint_demo) {
        self.$message.error('FEATURE DISABLED FOR DEMO')
        return false
      }
      self.saving = true
      axios.post(route, { data: data })
        .then(function (response) {
          self.$message.success('Changes saved!')
          self.saving = false
        })
        .catch(function (response) {
          console.log(JSON.stringify(response))
          self.saving = false
        })
    },
    // Env
    loadEnvContent: function () {
      var route = '/redprint/settings-manager/get-env-content'
      this.load(route, 'env')
    },
    saveEnv: function () {
      var route = '/redprint/settings-manager/set-env-content'
      this.save(route, this.env)
    },
    // Redprint
    loadRedprintConfig: function () {
      var route = '/redprint/settings-manager/get-redprint-config'
      this.load(route, 'redprint')
    },
    saveRedprintConfig: function () {
      var route = '/redprint/settings-manager/set-redprint-config'
      this.save(route, this.redprint)
    },
    // Permissible
    loadPermissibleConfig: function () {
      var route = '/redprint/settings-manager/get-permissible-config'
      this.load(route, 'permissible')
    },
    savePermissibleConfig: function () {
      var route = '/redprint/settings-manager/set-permissible-config'
      this.save(route, this.permissible)
    },
    // Theme
    // Redprint Unity
    loadThemeConfig: function () {
      var route = '/redprint/settings-manager/get-theme-config'
      this.load(route, 'theme')
    },
    saveThemeConfig: function () {
      var route = '/redprint/settings-manager/set-theme-config'
      this.save(route, this.theme)
    }


  },
  components: {
  }
})