<template>
  <div class="w-full mx-10 flex flex-col">
    <v-calendar
      v-model="dateCalendar"
      class="shadow-lg"
      is-dark
      is-expanded
      :attributes="attibutesCalendar"
      @dayclick="dayClicked"
    ></v-calendar>

    <div class="w-full text-gray-300 mt-10 flex flex-col">
      <p class="text-xl">Agenda: {{currentDay}}</p>

      <div
        v-if="dayMeetings.length === 0"
        class="w-full border-2 border-gray-400 flex flex-no-wrap w-full text-lg text-gray-200 py-5 mt-5 rounded-lg"
      >
        <div class="w-32 text-center flex items-center justify-center">
          <span class="mdi mdi-emoticon-sad-outline text-4xl font-bold"></span>
        </div>
        <div class="flex justify-center align-center items-center">
          <p>
            Você não tem nada agendado para este dia.
          </p>
        </div>
      </div>
      <div v-else>
        <div
          v-for="(meeting, im) in dayMeetings"
          :key="im"
          class="mt-5 border-2 border-gray-400 flex flex-no-wrap w-full p-5 rounded-lg"
        >
          <div class="w-32 mr-5 text-center">
            <p class="text-lg text-gray-200 font-bold">
              {{ meeting.date.toLocaleString('pt-BR', {day: '2-digit', month: '2-digit'}) }}
              <br>
              {{ meeting.date.getFullYear() }}
            </p>
            <p class="text-lg text-gray-300 font-bold">{{meeting.hour}} </p>
          </div>
          <div class="flex justify-center align-center items-center">
            <p class="text-lg">{{ meeting.title }}</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
  export default {
    name: "MeetingCalendar",
    props: {
      meetings: {
        required: true
      }
    },
    data () {
      return {
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
        currentDay: 'Hoje',
        dayMeetings: [],
        dateCalendar: new Date()
      }
    },
    mounted () {
      this.updateCalendar()
    },
    watch: {
      meetings () {
        this.updateCalendar()
      }
    },
    methods: {
      updateCalendar () {
        for (let m in this.meetings) {
          let meeting = this.meetings[m]
          this.attibutesCalendar.push({
            key: 'meeting_' + m,
            dot: {
              color: 'orange'
            },
            dates: meeting.date
          })

          if (this.sameDate(meeting.date)) {
            this.dayMeetings.push(meeting)
          }
        }
      },
      dayClicked (e) {
        this.dateCalendar = e.date
        this.attibutesCalendar = this.attibutesCalendar.map(attr => {
          if (attr.key === 'currentDay') {
            attr.dates = e.date
          }
          return attr
        })

        if (this.sameDate(e.date)) {
          this.currentDay = 'Hoje'
        } else {
          const day = e.date.getDay() < 10 ? '0' + e.date.getDay() : e.date.getDay()
          const month = (e.date.getMonth() + 1) < 10 ? '0' + (e.date.getMonth() + 1) : (e.date.getMonth() + 1)
          this.currentDay = day + '/' + month + '/' + e.date.getFullYear()
        }

        this.setCurrentDates(e.date)
      },
      setCurrentDates (date) {
        this.dayMeetings = []
        for (let m in this.meetings) {
          let meeting = this.meetings[m]
          if (this.sameDate(meeting.date, date)) {
            this.dayMeetings.push(meeting)
          }
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
