<template>
  <div>
    <div
      v-for="(meeting, index) in meetings"
      :key="index"
      class="flex w-full bg-white shadow-lg items-center py-6"
    >
      <agenda-list-detailed-card :meeting="meeting" />
    </div>
  </div>

</template>

<script>
  export default {
    name: "AgendasList",
    props: {
      meetings: {
        required: true
      }
    }
  }
</script>

<style scoped>

</style>
