<template>
  <div>
    <agendas-list :meetings="meetings"/>
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
