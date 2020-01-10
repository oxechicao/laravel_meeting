<template>
  <vue-modal
    :show-modal="showModal"
    @close="$emit('close')"
  >

    <div slot="header">
      Formulário de Agendamento
    </div>

    <div slot="body">
      <div class="flex flex-col">
        <div>
          <label :for="`title-${randomId}`">Título</label>
          <input
            v-model="$v.agenda.title.$model"
            :id="`title-${randomId}`"
            type="text"
            class="input-normal"
          >
          <small
            v-if="$v.agenda.title.$anyDirty && !$v.agenda.title.required"
            class="input-error"
          >* Campo obrigatório</small>
        </div>
        <div class="mt-5">
          <label :for="`date-${randomId}`">Data</label>
          <v-date-picker
            :id="`date-${randomId}`"
            v-model="$v.agenda.date.$model"
            color="orange"
          ></v-date-picker>
          <small
            v-if="$v.agenda.date.$anyDirty && !$v.agenda.date.required"
            class="input-error"
          >* Campo obrigatório</small>
        </div>
        <div class="mt-5">
          <label :for="`hour-${randomId}`">Hora</label>
          <input
            v-model.trim="$v.agenda.hour.$model"
            :id="`hour-${randomId}`"
            type="text"
            class="input-normal"
            v-mask="'##:##'"
            @keyup="verifyHours"
          >
          <small
            v-if="$v.agenda.hour.$anyDirty && (!$v.agenda.hour.required || !$v.agenda.hour.minLength)"
            class="input-error"
          >{{!$v.agenda.hour.required ? '* Campo obrigatório' : 'Preencha todos os dígitos'}}</small>
        </div>
        <div class="mt-5">
          <label :for="`desc-${randomId}`">Descrição</label>
          <textarea
            v-model.trim="agenda.description"
            :id="`desc-${randomId}`"
            class="input-normal"
          />
        </div>
        <div class="mt-5 flex flex-col w-full">
          <div class="flex justify-between items-center">
            <p class="text-lg">Participantes</p>
            <button
              title="Adicionar participante"
              class="mdi mdi-plus"
              @click="agenda.participants.push('')"
            />
          </div>

          <div class="h-full max:h-full">
            <div
              v-for="(iterator) in countParticipants"
              :key="iterator"
            >
              <div class="bg-gray-100 h-10 w-full my-2 px-3 py-1 flex justify-between items-center">
                <div class="overflow-x-auto mr-2 w-full">
                  <input
                    type="text"
                    class="input-normal"
                    v-model="agenda.participants[iterator -1]"
                  >
                </div>
                <div class="flex justify-end">
                  <button @click="removeParticipant(iterator -1)"><span class="mdi mdi-delete"/></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div slot="footer">
      <div class="flex justify-between w-full">
        <button class="text-orange-700 text-lg" @click="$emit('close')">Cancelar</button>
        <button
          @click="saveMeeting"
          class="px-3 py-2 bg-orange-700 text-white text-lg rounded-lg hover:shadow-lg hover:bg-orange-600"
        >
          Salvar
        </button>
      </div>
    </div>

  </vue-modal>
</template>

<script>
  import {required, minLength} from "vuelidate/lib/validators";

  export default {
    name: "AgendaFormModal",
    props: {
      actions: {
        required: true
      },
      showModal: {
        required: true
      },
      agendaProp: {
        default: () => Object.assign({})
      }
    },
    mounted () {
      this.agenda = Object.assign({}, this.agendaProp)
    },
    watch: {
      agendaProp () {
        this.agenda = Object.assign({}, this.agendaProp)
      }
    },
    data () {
      return {
        agenda: {
          title: '',
          date: '',
          hour: '',
          participants: []
        }
      }
    },
    validations: {
      agenda: {
        title: {required},
        date: {required},
        hour: {required, minLength: minLength(4)}
      }
    },
    computed: {
      randomId () {
        return 'form-modal-agenda-' + Math.random() * Math.floor(Math.random() * 1000)
      },
      countParticipants () {
        return this.agenda.participants.length
      }
    },
    methods: {
      verifyHours () {
        if (this.agenda.hour.length < 5) return

        let time = this.agenda.hour.split(':')
        time[0] = parseInt(time[0]) % 24 < 10 ? '0' + parseInt(time[0]) % 24 : (parseInt(time[0]) % 24).toString()
        time[1] = parseInt(time[1]) % 60 < 10 ? '0' + parseInt(time[1]) % 60 : (parseInt(time[1]) % 60).toString()

        this.agenda.hour = time.join(':')
      },
      removeParticipant (index) {
        this.agenda.participants = this.agenda.participants.splice(index, 1)
      },
      saveMeeting () {
        window.axios.put(this.actions.update + '/' + this.agenda.id, this.agenda)
        .then(res => {
          this.$emit('getAgendas')
          this.$emit('close')
        })
      }
    }
  }
</script>

<!--suppress CssInvalidAtRule -->
<style
  lang="scss"
  scoped
>
  label {
    @apply text-gray-900 text-lg;
  }

  .input-normal {
    @apply w-full text-gray-900 shadow rounded-lg px-3 py-2 border border-orange-400;
  }

  .input-normal:focus {
    @apply bg-gray-200 shadow-lg border-orange-300;
  }

  .input-error {
    @apply text-red-500 italic;
  }

</style>
