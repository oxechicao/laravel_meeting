<template>
  <div>
    <div
      v-if="todayMeeting.length === 0 && otherMeetings.length === 0"
      class=" bg-gray-100 text-gray-900 w-full border-2 border-gray-400 flex flex-no-wrap w-full text-lg text-gray-200 py-5 mt-5 rounded-lg"
    >
      <div class="w-32 text-center flex items-center justify-center">
        <span class="mdi mdi-emoticon-sad-outline text-4xl font-bold"></span>
      </div>
      <div class="flex justify-center align-center items-center">
        <p>
          Você ainda não agendou alguma reunião.
        </p>
      </div>
    </div>
    <div v-else>
      <div>
        <p class="text-2xl">
          Agenda do dia: {{dateCalendar.toLocaleString('pt-BR', {year: 'numeric', day: 'numeric', weekday: 'long',
          month:'long'})}}
        </p>
      </div>
      <div
        v-if="todayMeeting.length === 0"
        class="bg-gray-100 text-gray-900 w-full border-2 border-gray-400 flex flex-no-wrap w-full text-lg text-gray-200 py-5 mt-5 rounded-lg"
      >
        <div class="w-32 text-center flex items-center justify-center">
          <span class="mdi mdi-emoticon-sad-outline text-4xl font-bold"></span>
        </div>
        <div class="flex justify-center align-center items-center">
          <p>
            Você tem nada agendado para este dia.
          </p>
        </div>
      </div>
      <div
        v-else
        v-for="(meeting) in todayMeeting"
        :key="randomKey"
        class="flex w-full bg-white shadow-lg items-center py-6 my-10"
      >
        <agenda-list-detailed-card
          @getAgendas="$emit('getAgendas')"
          :actions="actions"
          :meeting="meeting"
        />
      </div>
      <div>
        <p class="text-2xl">Outras reuniões</p>
      </div>
      <div
        v-for="(meeting, index) in otherMeetings"
        :key="randomKey"
        class="flex w-full bg-white shadow-lg items-center py-6 my-10"
      >
        <agenda-list-detailed-card
          @getAgendas="$emit('getAgendas')"
          :actions="actions"
          :meeting="meeting"
        />
      </div>
    </div>
  </div>

</template>

<script>
  export default {
    name: "AgendasList",
    props: {
      dateCalendar: {
        default: new Date()
      },
      meetings: {
        required: true
      },
      actions: {
        required: true
      }
    },
    computed: {
      optionsL () {
        return {
          year: 'numeric',
          month: '2-digit',
          day: '2-digit'
        }
      },
      otherMeetings () {
        return this.meetings.filter(item => item.date.toLocaleString('pt-BR', this.optionsL) !== this.dateCalendar.toLocaleString('pt-BR', this.optionsL))
      },
      todayMeeting () {
        return this.meetings.filter(item => item.date.toLocaleString('pt-BR', this.optionsL) === this.dateCalendar.toLocaleString('pt-BR', this.optionsL))
      }
    },
    methods: {
      randomKey () {
        return Math.floor(Math.random() * 100000)
      }
    }
  }
</script>

<style scoped>

</style>
