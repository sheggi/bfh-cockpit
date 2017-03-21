/* global window, require, Vue */

window._ = require('lodash')

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery')

require('bootstrap-sass')

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue')

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios')

window.axios.defaults.headers.common = {
  'X-CSRF-TOKEN': window.Laravel.csrfToken,
  'X-Requested-With': 'XMLHttpRequest'
}

// /**
//  * Echo exposes an expressive API for subscribing to channels and listening
//  * for events that are broadcast by Laravel. Echo and event broadcasting
//  * allows your team to easily build robust real-time web applications.
//  */
//
// // import Echo from "laravel-echo"
//
// // window.Echo = new Echo({
// //     broadcaster: 'pusher',
// //     key: 'your-pusher-key'
// // })

/**
 * Enable Vue Resource
 */

require('vue-resource')
import VueMarkdown from 'vue-markdown'

/**
 * Register Components
 */

const Cockpit = require('./components/Cockpit.vue')
const DebugPanel = require('./components/DebugPanel.vue')
const LessonPanel = require('./components/LessonPanel.vue')
const LessonsPanel = require('./components/LessonsPanel.vue')
const TodayPanel = require('./components/TodayPanel.vue')
const NextDaysPanel = require('./components/NextDaysPanel.vue')
const PageLoadPanel = require('./components/PageLoadPanel.vue')
const PreviousDaysPanel = require('./components/PreviousDaysPanel.vue')

Vue.component('vue-markdown', VueMarkdown)
Vue.component(Cockpit.name, Cockpit)
Vue.component(DebugPanel.name, DebugPanel)
Vue.component(LessonPanel.name, LessonPanel)
Vue.component(LessonsPanel.name, LessonsPanel)
Vue.component(TodayPanel.name, TodayPanel)
Vue.component(NextDaysPanel.name, NextDaysPanel)
Vue.component(PageLoadPanel.name, PageLoadPanel)
Vue.component(PreviousDaysPanel.name, PreviousDaysPanel)
