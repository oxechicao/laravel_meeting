<template>
  <div class="flex w-full">
    <div v-if="meetings.length === 0">
      <empty-meeting></empty-meeting>
    </div>
    <div
      v-else
      class="w-full text-gray-700"
    >
      <content-meeting :meetings="meetings"></content-meeting>
    </div>
  </div>
</template>

<script>
  export default {
    name: "CardMeeting",
    data() {
      return {
        meetings: [
          {
            title: 'REUNIÃO PARA DISCUTIR A INVASÃO DO VERÃO ORIUNDO DO CENTRO',
            date: new Date(),
            contacts: [
              {
                name: 'John Snow',
                email: 'john.snow@sabedenada.com'
              },
              {
                name: 'Adelaide Odacilva',
                email: 'adecilva@gmail.com'
              },
              {
                name: '',
                email: 'carla.perez@eotchan.com'
              }, {
                name: 'John Snow',
                email: 'john.snow@sabedenada.com'
              },
              {
                name: 'Adelaide Odacilva',
                email: 'adecilva@gmail.com'
              },
              {
                name: '',
                email: 'carla.perez@eotchan.com'
              }
            ]
          }
        ]
      }
    }
  }
</script>

<style scoped>

</style>
