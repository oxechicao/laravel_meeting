<template>
  <div class="flex justify-start w-full h-full mb-16 text-gray-900">
    <div class="flex flex-col w-full md:w-8/12 mr-10">
      <div class="mb-5 w-full flex flex-wrap items-center">
        <div class="w-full md:w-1/6">
          <label
            class="w-full text-lg text-gray-800"
            :for="`title-${randomId}`"
          >
            Título
          </label>
        </div>
        <div class="w-full md:w-5/6">
          <input
            :id="`title-${randomId}`"
            v-model="title"
            type="text"
            class="w-full text-gray-900 focus:bg-gray-100 focus:shadow-lg shadow rounded-lg px-3 py-2 hover:border hover:border-orange-500"
          />

        </div>
      </div>
      <div class="mb-5 w-full flex flex-wrap items-center">
        <div class="w-full md:w-1/2 flex items-center">
          <div class="md:mr-24">
            <label class="text-lg text-gray-900">Data</label>
          </div>
          <div class="w-full ml-3">
            <input
              class="w-full px-3 py-2 text-gray-900 bg-gray-300 focus:shadow-lg shadow rounded-lg hover:border hover:border-orange-500"
              type="text"
              readonly
              :value="dateCalendar.toLocaleString('pt-BR', { year: 'numeric', month: 'numeric', day: 'numeric' })"
            >
          </div>
        </div>
        <div class="w-full md:w-1/2 flex items-center">
          <div class="mx-16">
            <label class="text-lg text-gray-900">Horário</label>
          </div>
          <input
            @keyup="verifyHours"
            class="w-full px-3 py-2 text-gray-900 focus:bg-gray-100 focus:shadow-lg shadow rounded-lg hover:border hover:border-orange-500"
            type="text"
            v-mask="'##:##'"
            v-model="hour"
          >
        </div>
      </div>
      <div class="w-full h-full flex flex-wrap items-center">
        <div class="w-full md:w-1/6">
          <label
            class="text-lg text-gray-900"
            :for="`description-${randomId}`"
          >Descrição</label>
        </div>
        <div class="w-full h-full md:w-5/6">
          <textarea
            :id="`description-${randomId}`"
            v-model="description"
            class="w-full h-full text-gray-900 focus:bg-gray-100 focus:shadow-lg shadow rounded-lg px-3 py-2 hover:border hover:border-orange-500"
            name="description-agenda"
            cols="30"
          />
        </div>

      </div>
    </div>
    <div class="flex flex-col w-full md:w-4/12">
      <div class="flex justify-between items-center">
        <p class="text-lg">Participantes</p>
        <button
          title="Adicionar participante"
          class="mdi mdi-plus"
          @click="addNewParticipant"
        />
      </div>
      <div class="h-full max:h-full overflow-y-scroll pr-3 mb-3">
        <div
          v-if="participants.length === 0"
          class="mx-5 my-5"
        >
          Nenhum participante adicionado
        </div>
        <div
          v-else
          v-for="(participant, index) in participants"
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
      <div class="self-end w-full">
        <button class="px-3 py-2 w-full bg-orange-700 text-white text-lg rounded-lg hover:shadow-lg hover:bg-orange-600">
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
  </div>
</template>

<script>
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
    data () {
      return {
        showModal: false,
        contact: {phones: []},
        title: '',
        hour: '',
        description: '',
        participants: ['john.snow@sabedenada.got', 'fulano@lambari.lol']
      }
    },
    computed: {
      randomId () {
        return 'form-agenda-' + (Math.random() * 1000 + Math.random() * 100)
      }
    },
    methods: {
      addNewParticipant () {
        this.showModal = true
      },
      addParticipant (email) {
        if (!this.participants.find(p => p === email)) {
          this.participants.push(email)
        }
        this.showModal = false
      },
      removeParticipant (email) {
        this.participants.splice(this.participants.indexOf(email), 1)
      },
      verifyHours () {
        if (this.hour.length < 5) return

        let time = this.hour.split(':')
        time[0] = parseInt(time[0]) % 24 < 10 ? '0' + parseInt(time[0]) % 24 : (parseInt(time[0]) % 24).toString()
        time[1] = parseInt(time[1]) % 60 < 10 ? '0' + parseInt(time[1]) % 60 : (parseInt(time[1]) % 60).toString()
        this.hour = time.join(':')
      }
    }
  }
</script>

<style scoped>

</style>
