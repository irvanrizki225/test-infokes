// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiBase: 'http://laravel-folder.test/api/v1',
    }
  },
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },

  css: [
    'bootstrap/dist/css/bootstrap.css'
  ],

  // Add this if you are using Bootstrap's JS
  plugins: [
    { src: '~/plugins/bootstrap.js', mode: 'client' }
  ],

  modules: ['@nuxt/image'],
  app: {
    head: {
      title: 'Folder Structure',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { hid: 'description', name: 'description', content: 'Folder Structure' }
      ],
      link: [
        { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
        //font awesome
        { rel: 'stylesheet', href: 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css' }
      ],
      script: [
        { src: 'https://code.jquery.com/jquery-3.6.0.min.js', integrity: 'sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=', crossorigin: 'anonymous' },
      ]
    }
  }
})