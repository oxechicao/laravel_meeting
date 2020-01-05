<template>
  <div>
    <div
      v-for="(meeting, index) in meetings"
      :key="index"
      class="flex w-full bg-white shadow-lg items-center py-6"
    >
      <div class="w-64  text-center">
        <p class="text-6xl text-orange-600 font-bold">
          {{ meeting.date.getDate() }}
        </p>
        <p class="text-lg text-orange-500 font-bold italic"> {{ monthNames[meeting.date.getMonth()] }}, {{
          meeting.date.getFullYear() }}</p>
        <p class="text-lg text-orange-500 font-bold"> {{ meeting.date.getHours() < '10' ? '0' + meeting.date.getHours() : meeting.date.getHours() }}:{{ meeting.date.getMinutes() < '10' ? '0' + meeting.date.getMinutes() : meeting.date.getMinutes() }} </p>
      </div>
      <div class="flex flex-col self-start">
        <div>
          <p class="text-2xl">{{ meeting.title }}</p>
        </div>
        <div class="flex mt-4">
          <div class="mt-2 mr-4">
            <p>Participantes:</p>
          </div>
          <div class="flex flex-wrap ">
            <div
              v-for="(contact, ic) in meeting.contacts"
              :key="ic"
            >
              <p class="my-2">
                <span class="font-bold mx-5">
                  {{contact.name !== '' ? contact.name : contact.email }}
                </span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "ContentMeeting",
    props: {
      meetings: {
        required: true
      }
    },
    data () {
      return {
        monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]
      }
    }
  }
</script>

<style scoped>

</style>
