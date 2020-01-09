<template>
  <span class="text-lg mx-3">
    <button
      title="Guia da página de agendamento de reuniões"
      @click="showModal = true"
    >
      <span class="mdi mdi-help-circle-outline"></span>
    </button>
    <vue-modal
      :showModal="showModal"
      ref="vue-modal-component"
      @close="showModal = false"
    >
      <div slot="header">Guida da página</div>
      <div slot="body">

      </div>
      <div
        slot="footer"
        class="text-right text-sm"
      ><button
        class="text-orange-700 font-bold"
        @click="showModal = false"
      >Fechar</button></div>
    </vue-modal>
  </span>
</template>

<script>
  export default {
    name: "AgendaPageHelp",
    data () {
      return {
        showModal: false
      }
    }
  }
</script>

<style scoped>

</style>
