<template>
  <div class="mx-10 md:mx-16">
    <div class="mb-10 w-full">
      <button
        class="px-6 py-2 bg-orange-600 hover:bg-orange-500 hover:shadown-lg flex items-center rounded-lg text-gray-200 font-bold"
        @click="addNew"
      >
        <span class="mdi mdi-plus"></span>
        <span>Novo Contato</span>
      </button>
    </div>
    <div class="flex flex-wrap">
      <div
        v-for="(contact, idc) in contacts"
        :key="idc"
        class="my-5 w-full lg:w-1/2 xl:w-1/3"
      >
        <contact-card
          class=""
          :contact="contact"
          :actions="actions"
        />
      </div>
    </div>

  </div>
</template>

<script>
  export default {
    name: "ContactIndex",
    props: {
      actions: {
        required: true
      }
    },
    data() {
      return {
        contacts: [
          {
            id: 1,
            name: 'John Snow',
            email: 'john.snow@sabedenada.got',
            phones: [
              '8598877665544'
            ]
          },
          {
            id: 1,
            name: 'John Snow',
            email: 'john.snow@sabedenada.got',
            phones: [
              '8598877665544'
            ]
          },
          {
            id: 1,
            name: 'John Snow',
            email: 'john.snow@sabedenada.got',
            phones: [
              '8598877665544'
            ]
          },
          {
            id: 1,
            name: 'John Snow',
            email: 'john.snow@sabedenada.got',
            phones: [
              '8598877665544'
            ]
          },
          {
            id: 1,
            name: 'John Snow',
            email: 'john.snow@sabedenada.got',
            phones: [
              '8598877665544'
            ]
          },
          {
            id: 1,
            name: 'John Snow',
            email: 'john.snow@sabedenada.got',
            phones: [
              '8598877665544'
            ]
          },
          {
            id: 1,
            name: 'John Snow',
            email: 'john.snow@sabedenada.got',
            phones: [
              '8598877665544'
            ]
          }
        ]
      }
    },
    methods: {
      addNew() {
        this.contacts = [{
          name: '',
          email: '',
          phones: []
        }].concat(this.contacts)
      }
    }
  }
</script>

<style scoped>

</style>
