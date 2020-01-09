<template>
  <div class="flex flex-col w-full">
    <div class="flex w-full">
      <div class="h-full">
        <v-calendar
          v-model="dateCalendar"
          is-expanded
          :attributes="attibutesCalendar"
          @dayclick="dayClicked"
        />
      </div>
      <div class="h-64 ml-0 md:ml-10  w-1/2">
        <agenda-form
          @findContacts="getAllContacts"
          :actions="actions"
          :dateCalendar="dateCalendar"
          :contacts="contacts"
        />
      </div>
    </div>
    <div>
      vizualização
    </div>
    <div>
      cards reuniões
    </div>
  </div>
</template>

<script>
  export default {
    name: 'AgendaIndex',

    props: {
      actions: {
        required: true
      }
    },

    mounted () {
      this.getAllContacts()
    },

    data () {
      return {
        contacts: [],
        attibutesCalendar: [
          {
            key: 'currentDay',
            highlight: {
              color: 'orange'
            },
            dates: new Date()
          }
        ],
        dateCalendar: new Date()
      }
    },

    methods: {
      dayClicked (e) {
        this.dateCalendar = e.date
        this.attibutesCalendar = this.attibutesCalendar.map(attr => {
          if (attr.key === 'currentDay') {
            attr.dates = e.date
          }
          return attr
        })
      },
      getAllContacts () {
        window.axios.get(this.actions.getAllContacts)
          .then(response => {
            this.contacts = response.data
          })
      }
    }
  }
</script>

<style scoped>

</style>
