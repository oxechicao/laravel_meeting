<template>
  <div class="bg-gray-100 h-10 w-full my-2 px-3 py-1 flex justify-between items-center">
    <div class="overflow-x-auto mr-2 w-full" :class="{'font-bold': contact !== undefined}">
      {{ contact ? contact.name : participant}}
    </div>
    <div class="flex justify-end">
      <button
        @click="addContact"
        v-if="!contact"
        class="mr-1"
      >
        <span class="mdi mdi-plus-box-outline"/>
      </button>
      <button
        @click="editContact"
        v-if="contact"
        class="mr-1"
      >
        <span class="mdi mdi-pen"/>
      </button>

      <button @click="$emit('remove', participant)"><span class="mdi mdi-delete"/></button>
    </div>
    <contact-modal-form
      @close="showModal = false"
      @findContacts="findContacts"
      :show-modal="showModal"
      :contact="contactModal"
      :actions="contactActions"
    />
  </div>
</template>

<script>
  export default {
    name: "AgendaCardParticipantAdded",
    props: {
      contacts: {
        required: true
      },
      participant: {
        required: true
      },
      actions: {
        required: true
      }
    },

    data () {
      return {
        showModal: false,
        contactModal: {phones: []}
      }
    },

    computed: {
      contact () {
        return this.contacts.find(c => c.email === this.participant)
      },

      contactActions () {
        return [
          this.actions.storeContact,
          this.actions.updateContact,
          this.actions.destroyContact
        ]
      }
    },
     methods: {
       addContact () {
         this.contactModal = {email: this.participant, phones: []}
         this.showModal = true
       },

       editContact () {
         this.contactModal = Object.assign({phones: ['']}, this.contact)
         this.showModal = true
       },

       findContacts () {
         this.$emit('findContacts')
         this.showModal = false
       }
     }
  }
</script>

<style scoped>

</style>
