  document.getElementById('app').focus()
  var token = document.head.querySelector('meta[name="csrf-token"]');
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
  axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

  Vue.component('filelist', {
      template: '#filelist',
      props: [
        'identifier', 
        'title', 
        'files', 
        'newfile', 
        'collapsed', 
        'defaultdir', 
        'createnewfile', 
        'loadfile', 
        'itemclass', 
        'hidepopover',
        'deletefile'
      ],
      data: function () {
          return {
          }
      },
      methods: {
        focusInputOne: function () {
          var self = this
          setTimeout(function(){
            self.$nextTick(function () {
              self.$refs.newFileInputOne.focus()
            })
          }, 500)
        },
        focusInputTwo: function () {
          var self = this
          setTimeout(function(){
            self.$nextTick(function () {
              self.$refs.newFileInputTwo[0].focus()
            })
          }, 500)
        }
      },
      mounted: function () {
      }
  })

  var app = new Vue({
    el: '#app',
    data: function () {
      return {
        fileSections: [
          { name: 'routes', collapsed: false, defaultDir: 'routes' },
          { name: 'models', collapsed: true, defaultDir: 'app' },
          { name: 'controllers', collapsed: true, defaultDir: 'app/Http/Controllers' },
          { name: 'views', collapsed: true, defaultDir: 'resources/views' },
          { name: 'migrations', collapsed: true, defaultDir: 'database/migrations' },
          { name: 'requests', collapsed: true, defaultDir: 'app/Http/Requests' },
          { name: 'console', collapsed: true, defaultDir: 'app/Console' },
          { name: 'providers', collapsed: true, defaultDir: 'app/Providers' },
          { name: 'exceptions', collapsed: true, defaultDir: 'app/Exceptions' }
        ],
        sidebarFileList: {
          routes: [],
          models: [],
          controllers: [],
          views: [],
          migrations: [],
          requests: [],
          console: [],
          providers: [],
          exceptions: [],
        },
        loadingSidebarFileList: false,
        // Currently active file information
        filePath: '',
        fileContent: '',
        openFiles: [],
        // Editor
        editorTheme: 'kuroir',
        editor: '',
        // Feeback
        showFeedbackOverlay: false,
        feedbackText: '',
        // Editor & Spotlight
        defaultEditorContent: 'Press `ctrl + p` to search for files \n' +
                              'or click on a file from left pane.\n' +
                              '--------------------------------\n' +
                              '? Click help button above to see a list of shortcuts',
        isFullscreen: false,
        fullScreenEnabled: screenfull.isFullscreen,
        distractionFreeEditor: false,
        showFileBrowserMenu: true,
        spotlightInput: '',
        spotlight: false,
        spotlightFileList: [],

        // File operation
        isFetchingFileList: false,
        fileSearchQueryIsDirty: false,
        loadingFileList: false,
        saving: false,
        // Themer
        showHelp: false,
        showThemer: false,
        newFile: {
          name: '',
          path: ''
        }
      }
    },
    computed: {
      editorSpan: function () {
        if (this.showFileBrowserMenu) {
          return 'col-xl-9 col-lg-9 col-md-9 col-xs-12'
        }
        return this.distractionFreeEditor || !this.showFileBrowserMenu ? 'col-md-12' : 'col-xl-9 col-lg-9 col-md-9 col-xs-12'
      },
      sideBarClass: function () {
        return this.isFullscreen ? 'darkSidebar' : 'whiteSidebar'
      }
    },
    mounted: function () {
      this.loadSidebarFiles()
      this.initEditor()
      this.initHotkeys()
      this.$watch('fullScreenEnabled', function (value) {
        this.isFullscreen = value
      })
    },
    methods:{
      // Editor
      initEditor: function () {
        this.editor = ace.edit('editor')
        this.editor.setTheme('ace/theme/kuroir')
        this.editor.session.setMode('ace/mode/html')
      },

      setEditorWithData: function (fileData, spotlight = false) {
        this.saving = false
        this.fileContent = fileData.content
        this.filePath = fileData.path
        this.editor.session.setMode('ace/mode/' + fileData.lang)
        this.editor.setValue(this.fileContent)
        if (spotlight) {
          this.toggleSpotlight()
        }
      },

      // File browser
      getFileList: function () {
        var self = this
        self.loadingFileList = true
        var route = '/redprint/code-editor/get-file-list'
        self.spotlightFileList = []
        axios.get(route, { params: { term: self.spotlightInput }})
          .then(function (response) {
            // console.log(JSON.stringify(response))
            self.spotlightFileList = response.data
            self.loadingFileList = false
            self.isFetchingFileList = false
            self.fileSearchQueryIsDirty = false
          }, function (response) {
            self.loadingFileList = false
            self.isFetchingFileList = false
            self.fileSearchQueryIsDirty = false
            console.log('Error getting file list.')
          })
      },

      searchFileList: _.debounce(function () {
        var self = this
        if (self.spotlightInput.length < 2) {
          return false
        }
        this.isFetchingFileList = true
        setTimeout(function () {
          this.fileSearchQueryIsDirty = false
          this.getFileList()
        }.bind(this), 1000)
      }, 500),

      loadSidebarFiles: function () {
        var self = this
        this.loadingSidebarFileList = true
        var route = '/redprint/code-editor/get-sidebar-file-list'
        axios.get(route)
          .then(function (response) {
            self.sidebarFileList = response.data
            self.loadingSidebarFileList = false
          })
          .catch(function (response) {
            console.log(JSON.stringify(response))
          })
      },

      createNewFile: function (filePath) {
        var self = this
        this.newFile.path = filePath
        var route = '/redprint/code-editor/create-file'

        axios.post(route, this.newFile)
          .then(function (response) {
            self.$message.success(response.data.path + ' has been created!')
            self.hidePopover()
            self.loadSidebarFiles()
            var fileData = { name: self.newFile.name, lang: '', path: response.data.path }
            self.loadFile(fileData)
            self.newFile = { name: '', path: '' }
          })
          .catch(function (response) {
            self.$message.error('Error creating file...')
            console.log(JSON.stringify(response))
          })
        
      },

      deleteFile: function (filePath) {
        var self = this
        if(window.redprint_demo) {
          self.$message.error('FEATURE DISABLED FOR DEMO')
          return false
        }
        var route = '/redprint/code-editor/delete-file'
        axios.post(route, { path: filePath })
          .then(function (response) {
            self.$message.success(filePath + ' is deleted!')
            self.hidePopover()
            self.loadSidebarFiles()
          })
          .catch(function (response) {
            self.$message.error('Error deleting file...')
            console.log(JSON.stringify(response))
          })
      },

      loadFile: function (fileData, spotlight = false) {
        var self = this
        // console.log(fileData)
        self.fileContent = ''

        // Try to load from local storage
        var alreadyOpened = self.openFiles.find(function (item) {
          return item.path === fileData.path
        })

        if(alreadyOpened) {
          console.log('Loading from cache.')
          self.setEditorWithData(alreadyOpened)
          return true
        }

        // Prevent opening new file if currently opened file count is more than 10
        if(self.openFiles.length > 6) {
          self.$notify.error('Too many files open... Please close some of the open files and retry.')
          return false
        }
        console.log('Loading from device')
        // Try to load from device
        var route = '/redprint/code-editor/get-file-content'
        axios.post(route, { path: fileData.path, lang: fileData.lang })
          .then(function (response) {
            fileData.content = response.data.content
            fileData.loaded = true
            self.setEditorWithData(fileData, spotlight)
            // Push it to current stack of files
            self.openFiles.push(fileData)
          })
          .catch(function (response) {
            self.$message.error('Error loading file...')
            console.log(JSON.stringify(response))
          })
        // console.log(filePath)
      },

      closeFile: function (index) {
        
        // If closing file is active, we need to present an empty space
        if (this.filePath === this.openFiles[index]['path']) {
          console.log('matched')
          this.filePath = ''
          this.fileContent = ''
        }
        this.$delete(this.openFiles, index)
      },

      switchToFile: function (index) {
        var file = this.openFiles[index]
        if (!file) {
          console.log('file not in list. Switching to first file')
          file = this.openFiles.slice(-1)[0]
        }
        if (!file) {
          this.filePath = ''
          this.fileContent = ''
          this.setEditorWithData({ path: '', content: this.defaultEditorContent, lang: 'HTML' })
          console.log('No file to open. Aborting...')
          // switching aborted.
          return true
        }
        console.log('Switching to' + file.path)
        // Save changes of previous file to local storage
        this.saveLocalChangesToPreviousFile()
        this.loadFile(file)
      },
      saveLocalChangesToPreviousFile: function () {
        // 1. Was there an opened file?
        if (!this.filePath) {
          return false
        }
        
        var index = this.openFiles.findIndex(item => item.path === this.filePath)
        if (index !== undefined) {
          this.openFiles[index]['content'] = this.editor.getValue()
        }
        return true
      },

      saveChanges: function () {
        var self = this
        this.saving = true

        // Make sure there are no syntax errors
        var hasError = false
        var annotations = this.editor.getSession().getAnnotations()
        for(var i=0; i < annotations.length; i++) {
          if(annotations[i]['type'] === 'error') {
            hasError = true
          }
        }

        if(hasError) {
          self.$message.error('You have syntax errors in your code! Please fix them and try again.')
          self.saving = false
          return false
        }
        if(window.redprint_demo) {
          self.$message.error('FEATURE DISABLED FOR DEMO.')
          self.saving = false
          return false
        }
        // Save changes
        var route = '/redprint/code-editor/put-file-content'
        var content = this.editor.getValue()
        axios.post(route, { path: this.filePath, content: content })
          .then(function (response) {
            self.$message.success('Changes saved!')
            self.saving = false
          })
          .catch(function (response) {
            console.log(JSON.stringify(response))
            self.$message.error('Error saving file...')
            self.saving = false
          })
      },

      // Utilities
      themeNavLink: function (theme) {
        return this.editorTheme === theme ? 'list-group-item active' : 'list-group-item'
      },
      fileListItemClass: function (path) {
        return this.filePath === path ? 'list-group-item active' : 'list-group-item'
      },
      changeTheme: function (theme) {
        this.editorTheme = theme
        this.editor.setTheme('ace/theme/' + theme)
      },
      hidePopover: function () {
        this.$nextTick(function () {
          document.getElementById('app').click()
        })
      },
      toolbarIcon: function (state) {
        return state ? 'filebrowser-toolbar-item active' : 'filebrowser-toolbar-item'
      },
      fileIsActive: function (filePath) {
        return this.filePath === filePath ? 'nav-link active' : 'nav-link'
      },
      initHotkeys: function () {
        var self = this
        window.addEventListener('keydown', function(event) {
          console.log(JSON.stringify(event.keyCode))
          self.feedbackText = ''
          self.showFeedbackOverlay = true

          // Catch different short cut key events

          // Open file browser
          if (event.ctrlKey && event.altKey && event.keyCode == 80) {
            self.stopPropagationVue(event)
            self.feedbackText = 'ctrl + alt + p'
            self.toggleSpotlight()
          }

          // Toggle filebrowser
          if (event.ctrlKey && event.altKey && event.keyCode == 66) {
            self.stopPropagationVue(event)
            self.feedbackText = 'ctrl + alt + b'
            self.fileBrowserMenuToggle()
          }

          // Fullscreen
          if (event.ctrlKey && event.altKey && event.keyCode == 70) {
            self.stopPropagationVue(event)
            self.feedbackText = 'ctrl + alt + f'
            self.distractionFreeToggle()
          }

          // Save
          if (event.ctrlKey && event.keyCode == 83) {
            self.stopPropagationVue(event)
            self.feedbackText = 'ctrl + S'
            self.saveChanges()
          }

          // Exit file browser / ESC Key
          if (event.keyCode == 27 && self.spotlight) {
            self.stopPropagationVue(event)
            self.feedbackText = 'Esc'
            self.toggleSpotlight()
          }

          // Hide shortcut key overlay
          if (!self.feedbackText.length) {
            self.showFeedbackOverlay = false
          } else {
            setTimeout(function(){
              self.showFeedbackOverlay = false
            }, 2000)
          }

        }, false)
      },
      stopPropagationVue: function (event) {
          event.preventDefault()
          event.stopPropagation()
      },
      // Toggles
      fileBrowserMenuToggle: function () {
        this.showFileBrowserMenu = !this.showFileBrowserMenu
      },
      distractionFreeToggle: function () {
        document.getElementById('app-side-mini-toggler').click()
        if (this.showFileBrowserMenu && !this.distractionFreeEditor) {
          this.fileBrowserMenuToggle()
        }
        this.distractionFreeEditor = !this.distractionFreeEditor
        var element = document.getElementById('editorPanel')
        var isFullscreen = screenfull.isFullscreen
        screenfull.toggle(element)
        this.isFullscreen = !isFullscreen
      },
      toggleSpotlight: function (close = false) {
        var self = this
        if (close === true) {
          this.spotlight = false
          return true
        }
        var currentState = this.spotlight
        this.spotlight = !this.spotlight
        if (!currentState) {
          console.log('focusing')
          this.$nextTick(function () {
            self.$refs.spotlightInput.focus()
          })
        }
      },
    },
    components: {
    },
    created: function () {
    },
  })