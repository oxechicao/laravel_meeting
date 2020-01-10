<template>
  <div class="w-full">
    <div class="my-12 w-full flex justify-center">
      <meeting-calendar :meetings="meetings"></meeting-calendar>
    </div>
  </div>
</template>

<script>
  export default {
    name: "RightSidebar",
    props: {
      actions: {
        required: true
      }
    },
    mounted () {
      this.getAgendas()
    },
    data () {
      return {
        meetings: []
      }
    },
    methods: {
      getAgendas () {
        window.axios.get(this.actions[0])
        .then(result => {
          this.meetings = result.data.map(item => {
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
