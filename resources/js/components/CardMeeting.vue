<template>
  <div class="flex w-full">
    <div v-if="meetings.length === 0">
      <empty-meeting></empty-meeting>
    </div>
    <div
      v-else
      class="w-full text-gray-700"
    >
      <div
        v-for="(meeting, i) in meetings"
        :key="i"
        class="flex w-full bg-white shadow-lg items-center py-6 mb-10"
      >
        <agenda-list-detailed-card
          :show-actions="false"
          :meeting="meeting"
        />
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "CardMeeting",
    props: {
      actions: {
        required: true
      }
    },
    data () {
      return {
        meetings: []
      }
    },
    mounted () {
      this.getAllNextAgendas()
    },
    methods: {
      getAllNextAgendas () {
        window.axios.get(this.actions[0])
          .then(res => {
            this.meetings = res.data.map(item => {
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
