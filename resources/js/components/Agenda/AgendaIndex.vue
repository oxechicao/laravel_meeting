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
      <div class="h-64 ml-0 md:ml-10  w-full pr-16">
        <agenda-form
          @findContacts="getAllContacts"
          :actions="actions"
          :dateCalendar="dateCalendar"
          :contacts="contacts"
        />
      </div>
    </div>
    <div class="w-full mt-16 pr-16">
      <agendas-list :meetings="meetings"/>
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
      this.getAllMeetings()
    },

    data () {
      return {
        meetings: [],
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
      },
      getAllMeetings () {
        window.axios.get(this.actions.all)
          .then(response => {
            this.meetings = response.data.map(item => {
              if (item.hasOwnProperty('date') && item.date) {
                item.date = new Date(item.date)
              }
              return item
            })
          })
      }
    }
  }
</script>

<style scoped>

</style>
