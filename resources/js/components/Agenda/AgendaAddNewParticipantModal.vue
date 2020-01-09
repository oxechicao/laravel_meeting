<template>
  <vue-modal
    :showModal="showModal"
    ref="vue-modal-component"
    @close="$emit('close')"
  >
    <div slot="header">Adicionar novo participante</div>

    <div slot="body">
      <div class="flex flex-col text-gray-900">
        <label for="form-add-new-email" class="text-lg">E-mail</label>
        <input
          v-model="email"
          id="form-add-new-email"
          type="email"
          class="px-3 py-2 focus:bg-gray-200 border border-orange-500 focus:border-orange-300 rounded-lg focus:shadow mt-5"
          placeholder="pessoa@email.com"
          required
          @keyup.enter="confirm"
        >
        <small class="font-thin mt-1 text-gray-700">
          * Campo obrigatório
        </small>
      </div>
    </div>

    <div slot="footer">
      <div class="flex justify-between">
        <button
          class="px-3 py-1 text-orange-700 hover:text-orange-600 hover:shadown-lg"
          @click="$emit('close')"
          title="Cancelar adição de participante"
        >Cancelar
        </button>
        <button
          class="px-3 py-1 bg-orange-700 text-white hover:bg-orange-600 hover:shadown-lg"
          title="Confirmar adição do participante"
          @click="confirm"
        >
          Adicionar
        </button>
      </div>
    </div>
  </vue-modal>
</template>

<script>
  export default {
    name: "AgendaAddNewParticipantModal",
    props: {
      showModal: {
        default: false
      }
    },
    data () {
      return {
        email: ''
      }
    },
    methods: {
      confirm () {
        if (this.email !== '') this.$emit('addParticipant', this.email)
        this.email = ''
      }
    }
  }
</script>

<style scoped>

</style>
