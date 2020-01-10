<template>
  <vue-modal
    :showModal="showModal"
    ref="vue-modal-component"
    @close="$emit('close')"
  >
    <div slot="header">Confirmação</div>
    <div slot="body">
      <p class="text-lg font-bold mb-5">Você tem certeza que deseja remover?</p>
      <p class="ml-3">{{agenda.title}}</p>
      <p class="ml-3">{{agenda.date.toLocaleString('pt-BR', {year: 'numeric', weekday: 'long', day: 'numeric', month:
        'numeric'})}}</p>
      <p class="ml-3">{{agenda.hour }}</p>
    </div>
    <div slot="footer">
      <div class="flex justify-between">
        <button
          class="px-3 py-1 text-orange-700 hover:text-orange-600 hover:shadown-lg"
          @click="confirm"
        >Remover
        </button>
        <button
          class="px-3 py-1 rounded-lg bg-orange-700 text-white hover:bg-orange-600 hover:shadow-lg"
          @click="$emit('close')"
        >Cancelar
        </button>
      </div>
    </div>
  </vue-modal>
</template>

<script>
  export default {
    name: 'AgendaRemoveConfirm',
    props: {
      agenda: {
        required: true
      },
      showModal: {
        default: false
      },
      action: {
        required: true
      }
    },
    methods: {
      confirm () {
        window.axios.delete(this.action + '/' + this.agenda.id)
          .then(res => {
            this.$emit('getAgendas')
            this.$emit('close')
          })
      }
    }
  }
</script>

<style scoped>

</style>
