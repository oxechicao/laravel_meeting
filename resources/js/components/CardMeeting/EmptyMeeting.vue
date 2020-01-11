<template>
  <div class="md:max-w-sm w-full lg:max-w-full lg:flex bg-white shadow-lg items-center">
    <div
      class="lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden bg-white"
    >
      <span class="mdi mdi-emoticon-sad-outline text-6xl text-gray-500"></span>
    </div>
    <div class="bg-white p-4 flex flex-col justify-between leading-normal">
      <p class="font-bold text-2xl text-gray-700">
        Você não tem reuniões marcadas para os próximos dias.
      </p>
    </div>
  </div>
</template>

<script>
  export default {
    name: "EmptyMeeting"
  }
</script>

<style scoped>

</style>
