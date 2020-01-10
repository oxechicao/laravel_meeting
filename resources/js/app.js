/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('vue-modal', require('./components/VueModal.vue').default);
Vue.component('custom-calendar', require('./components/CustomCalendar.vue').default);

Vue.component('card-meeting', require('./components/CardMeeting.vue').default);
Vue.component('content-meeting', require('./components/CardMeeting/ContentMeeting.vue').default);
Vue.component('empty-meeting', require('./components/CardMeeting/EmptyMeeting.vue').default);

Vue.component('meeting-calendar', require('./components/MeetingCalendar.vue').default);
Vue.component('quick-actions', require('./components/QuickActions.vue').default);
Vue.component('right-sidebar', require('./components/RightSidebar.vue').default);

Vue.component('contact-index', require('./components/Contact/ContactIndex').default);
Vue.component('contact-card', require('./components/Contact/ContactCard').default);
Vue.component('contact-form', require('./components/Contact/ContactForm').default);
Vue.component('contact-remove-confirm', require('./components/Contact/ContactRemoveConfirm').default);
Vue.component('contact-modal-form', require('./components/Contact/ContactModalForm').default);

Vue.component('agenda-index', require('./components/Agenda/AgendaIndex').default);
Vue.component('agendas-list', require('./components/Agenda/AgendasList').default);
Vue.component('agenda-list-detailed-card', require('./components/Agenda/AgendaListDetailedCard').default);
Vue.component('agenda-page-help', require('./components/Agenda/AgendaPageHelp').default);
Vue.component('agenda-form', require('./components/Agenda/AgendaForm').default);
Vue.component('agenda-add-new-participant-modal', require('./components/Agenda/AgendaAddNewParticipantModal').default);
Vue.component('agenda-card-participant-added', require('./components/Agenda/AgendaCardParticipantAdded').default);
Vue.component('agenda-confirm-save', require('./components/Agenda/AgendaConfirmSave').default);


import VCalendar from 'v-calendar';

Vue.use(VCalendar);

import VueTheMask from 'vue-the-mask'

Vue.use(VueTheMask)

import Vuelidate from 'vuelidate'

Vue.use(Vuelidate)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
});
