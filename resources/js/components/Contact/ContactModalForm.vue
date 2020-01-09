<template>
  <vue-modal
    :showModal="showModal"
    ref="vue-modal-component-contact"
    @close="$emit('close')"
  >
    <div slot="header">Formulário de contato</div>

    <div slot="body">
      <contact-form
        @findContacts="findContacts"
        :contact="contact"
        :actions="actions"
      />
    </div>
  </vue-modal>
</template>

<script>
  export default {
    name: "ContactModalForm",
    props: {
      actions: {
        required: true
      },
      contact: {
        required: true
      }
    }
  }
</script>

<style scoped>

</style>
