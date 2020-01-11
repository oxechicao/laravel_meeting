<template>
  <div class="flex flex-col w-full h-full">
    <div class="flex flex-wrap xl:flex-no-wrap w-full pr-10 lg:pr-0 mb-16">
      <div class="flex h-full w-full justify-center xl:w-auto mb-10 xl:mb-0 md:pr-0">
        <v-calendar
          v-model="dateCalendar"
          :attributes="attibutesCalendar"
          @dayclick="dayClicked"
        />
      </div>
      <div class="h-64 ml-0 xl:ml-10 w-full pr-16">
        <agenda-form
          @getAgendas="getAllMeetings"
          :actions="actions"
          :dateCalendar="dateCalendar"
          :contacts="contacts"
        />
      </div>
    </div>
    <div class="w-full h-full mt-40 xl:mt-0 pr-16">
      <agendas-list
        :date-calendar="new Date(dateCalendar)"
        @getAgendas="getAllMeetings"
        :actions="actions"
        :meetings="meetings"
      />
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
      this.defineCalendar()
    },

    data () {
      return {
        meetings: [],
        contacts: [],
        attibutesCalendar: [
          {
            key: 'currentDay',
            highlight: {
              color: 'orange',
              fillMode: 'light'
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
            this.defineCalendar()
          })
      },
      defineCalendar () {
        for (let m in this.meetings) {
          let meeting = this.meetings[m]
          this.attibutesCalendar.push({
            key: 'meeting_' + m,
            dot: {
              color: 'orange',
              class: 'bg-orange-500 text-orange-500'
            },
            dates: meeting.date
          })
        }
      },
      sameDate (date, otherDate) {
        const now = otherDate || new Date()
        return date.getDay() === now.getDay() &&
          date.getMonth() === now.getMonth() &&
          date.getFullYear() === now.getFullYear()
      }
    }
  }
</script>

<style scoped>

</style>
