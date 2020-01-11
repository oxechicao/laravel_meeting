<template>
  <div class="flex flex-wrap xl:flex-no-wrap justify-start w-full h-full mb-16 text-gray-900">
    <!--    XL - LEFT FORM-->
    <div class="flex flex-wrap xl:flex-no-wrap flex-col w-full mb-5 lg:mb-0 xl:w-8/12 lg:mr-10">
      <!--      TITLE         -->
      <div class="mb-5 w-full flex flex-wrap items-center">
        <div class="w-full lg:w-1/6">
          <label
            class="w-full text-lg text-gray-800"
            :for="`title-${randomId}`"
          >
            Título
          </label>
        </div>
        <div class="w-full lg:w-5/6 xl:pl-3">
          <input
            :id="`title-${randomId}`"
            v-model.trim="$v.agenda.title.$model"
            type="text"
            class="w-full text-gray-900 focus:bg-gray-100 focus:shadow-lg shadow rounded-lg px-3 py-2"
            :class="{'border border-red-500': $v.agenda.title.$anyDirty && !$v.agenda.title.required}"
          />
        </div>
      </div>
      <!--      DATE -->
      <div class="mb-5 w-full flex flex-wrap items-center">
        <div class="w-full mb-5 lg:mb-0 lg:w-1/2 flex flex-wrap items-center">
          <div class="w-full lg:w-1/3">
            <label class="text-lg text-gray-900">Data</label>
          </div>
          <div class="w-full lg:w-2/3 xl:pl-3">
            <input
              class="w-full px-3 py-2 text-gray-900 bg-gray-300 focus:shadow-lg shadow rounded-lg hover:border hover:border-orange-500"
              type="text"
              readonly
              :value="dateCalendar.toLocaleString('pt-BR', { year: 'numeric', month: 'numeric', day: 'numeric' })"
            >
          </div>
        </div>
        <div class="w-full mb-5 lg:mb-0 lg:w-1/2 flex flex-wrap lg:flex-no-wrap items-center">
          <div class="w-full lg:w-1/3 lg:mx-16 xl:mx-10">
            <label class="text-lg text-gray-900">Horário</label>
          </div>
          <div class="w-full lg:2/3">
            <input
              @keyup="verifyHours"
              class="w-full px-3 py-2 text-gray-900 focus:bg-gray-100 focus:shadow-lg shadow rounded-lg hover:border hover:border-orange-500"
              type="text"
              v-mask="'##:##'"
              v-model="$v.agenda.hour.$model"
              :class="{'border border-red-500': $v.agenda.hour.$anyDirty && !$v.agenda.hour.required}"
            >
          </div>
        </div>
      </div>
      <!--      DESCRIPTION-->
      <div class="mb-5 w-full xl:h-full flex flex-wrap xl:flex-no-wrap items-center">
        <div class="w-full lg:w-1/6">
          <label
            class="text-lg text-gray-900"
            :for="`description-${randomId}`"
          >Descrição</label>
        </div>
        <div class="w-full h-full lg:w-5/6 xl:pl-3">
          <textarea
            :id="`description-${randomId}`"
            v-model="agenda.description"
            class="w-full h-full text-gray-900 focus:bg-gray-100 focus:shadow-lg shadow rounded-lg px-3 py-2 hover:border hover:border-orange-500"
            name="description-agenda"
            cols="30"
          />
        </div>

      </div>
    </div>

    <!--    XL - RIGHT FORM-->
    <div class="flex flex-wrap xl:flex-no-wrap xl:flex-col w-full h-full xl:w-4/12">
      <div class="flex w-full justify-between items-center">
        <p class="text-lg">Participantes</p>
        <button
          title="Adicionar participante"
          class="mdi mdi-plus"
          @click="addNewParticipant"
        />
      </div>
      <div class="flex w-full h-auto xl:h-full max:h-full overflow-y-scroll pr-3 mb-3">
        <div
          v-if="agenda.participants.length === 0"
          class="mx-5 my-5"
        >
          Nenhum participante adicionado
        </div>
        <div
          v-else
          class="w-full"
        >
          <div
            class="w-full"
            v-for="(participant, index) in agenda.participants"
            :key="index"
          >

            <agenda-card-participant-added
              @close="showModal = false"
              @remove="removeParticipant"
              @findContacts="$emit('findContacts')"
              :actions="actions"
              :contacts="contacts"
              :participant="participant"
            />
          </div>
        </div>
      </div>
      <div class="w-full">
        <button
          @click="saveMeeting"
          class="px-3 py-2 w-full bg-orange-700 text-white text-lg rounded-lg hover:shadow-lg hover:bg-orange-600"
        >
          Agendar reunião
        </button>
      </div>
    </div>

    <agenda-add-new-participant-modal
      @close="showModal = false"
      @addParticipant="addParticipant"
      :show-modal="showModal"
      :contact="contact"
    />

    <agenda-confirm-save
      @close="showConfirModal = false"
      @getAgendas="$emit('getAgendas')"
      :actions="actions"
      :agenda="agenda"
      :show-modal="showConfirModal"
    />

  </div>
</template>

<script>
  import {required} from 'vuelidate/lib/validators'

  export default {
    name: 'AgendaForm',
    props: {
      actions: {
        required: true
      },
      dateCalendar: {
        required: true
      },
      contacts: {
        required: true
      }
    },
    watch: {
      dateCalendar () {
        this.agenda.date = this.dateCalendar
      }
    },
    mounted () {
      this.$v.$reset()
    },
    data () {
      return {
        showModal: false,
        showConfirModal: false,
        agenda: {
          title: '',
          description: '',
          date: this.dateCalendar,
          hour: '',
          participants: []
        },
        contact: {phones: []}
      }
    },
    validations: {
      agenda: {
        title: {required},
        date: {required},
        hour: {required}
      }
    },
    computed: {
      randomId () {
        return 'form-agenda-' + (Math.random() * 1000 + Math.random() * 100)
      }
    },
    methods: {
      saveMeeting () {
        this.$v.$touch()
        if (!this.$v.$invalid) {
          this.showConfirModal = true
        }
      },
      addNewParticipant () {
        this.showModal = true
      },
      addParticipant (email) {
        if (!this.agenda.participants.find(p => p === email)) {
          this.agenda.participants.push(email)
        }
        this.showModal = false
      },
      removeParticipant (email) {
        this.agenda.participants.splice(this.agenda.participants.indexOf(email), 1)
      },
      verifyHours () {
        if (this.agenda.hour.length < 5) return

        let time = this.agenda.hour.split(':')
        time[0] = parseInt(time[0]) % 24 < 10 ? '0' + parseInt(time[0]) % 24 : (parseInt(time[0]) % 24).toString()
        time[1] = parseInt(time[1]) % 60 < 10 ? '0' + parseInt(time[1]) % 60 : (parseInt(time[1]) % 60).toString()

        this.agenda.hour = time.join(':')
      }
    }
  }
</script>

<style scoped>

</style>
