<template>
  <div class="w-full">
    <div class="w-full">
      <quick-actions></quick-actions>
    </div>
    <div class="my-12 w-full flex justify-center">
      <meeting-calendar :meetings="meetings"></meeting-calendar>
    </div>
  </div>
</template>

<script>
  export default {
    name: "RightSidebar",
    data () {
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
