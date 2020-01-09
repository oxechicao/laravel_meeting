<template>
  <vue-modal
    :show-modal="showModal"
    @close="$emit('close')"
  >
    <div slot="header">
      Confirmar agendamento
    </div>
    <div slot="body">
      <div class="px-10">
        <table>
          <tbody>
          <tr>
            <td>
              <span class="field-name">Título:</span>
            </td>
            <td>
              <span>{{agenda.title}}</span>
            </td>
          </tr>
          <tr>
            <td>
              <span class="field-name">Descrição:</span>
            </td>
            <td>
              <span>{{agenda.description}}</span>
            </td>
          </tr>
          <tr>
            <td>
              <span class="field-name">Data:</span>
            </td>
            <td>
              <span>{{agenda.date.toLocaleString('pt-BR', {year: 'numeric', day: 'numeric', month: 'numeric', weekday: 'long'})}}</span>
            </td>
          </tr>
          <tr>
            <td>
              <span class="field-name">Hora:</span>
            </td>
            <td>
              <span>{{agenda.hour}}</span>
            </td>
          </tr>
          <tr>
            <td>
              <span class="field-name">Participantes:</span>
            </td>
            <td>
              <span>{{agenda.participants.join(', ')}}</span>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div slot="footer">
      <div class="flex justify-between">
        <button
          @click="$emit('close')"
          class="text-orange-700"
        >Cancelar
        </button>
        <button
          @click="save"
          class="px-5 py-2 bg-orange-700 text-white font-bold rounded-lg hover:bg-orange-600 shadow-lg"
        >Salvar
        </button>
      </div>
    </div>
  </vue-modal>
</template>

<script>
  export default {
    name: "AgendaConfirmSave",
    props: {
      showModal: {
        default: false,
        type: Boolean
      },
      agenda: {
        required: true
      },
      actions: {
        required: true
      }
    },

    methods: {
      save () {
        if (this.agenda.hasOwnProperty('id')) return this.updateForm()
        return this.storeForm()
      },
      storeForm () {
        return window.axios.post(this.actions.store, this.agenda)
      },
      updateForm () {
        return window.axios.put(this.actions.update + '/' + this.agenda.id, this.agenda)
      }
    }
  }
</script>

<style
  lang="scss"
  scoped
>
  .field-name {
    @apply font-bold text-lg mr-5 my-3;
  }

  td {
    @apply py-2;
  }

  td:nth-child(odd) {
    @apply text-right;
    vertical-align: top;
  }
</style>
