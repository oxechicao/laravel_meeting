<template>
<vue-modal
  :showModal="showModal"
  ref="vue-modal-component"
  @close="$emit('close')"
>
  <div slot="header">Confirmação</div>
  <div slot="body">
    <p class="text-lg font-bold mb-5">Você tem certeza que deseja remover?</p>
    <p class="ml-3">{{contact.name}}</p>
    <p class="ml-3">{{contact.email}}</p>
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
  name: 'ContactRemoveConfirm',
  props: {
    contact: {
      required: true
    },
    showModal: {
      default: false
    }
  },
  methods: {
    confirm () {
      this.$emit('delete')
      this.$emit('close')
    }
  }
}
</script>

<style scoped>

</style>
