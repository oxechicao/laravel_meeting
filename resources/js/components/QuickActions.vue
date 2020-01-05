<template>
  <div class="w-full">
    <div class="flex flex-wrap w-full text-gray-300 justify-center">
      <div class="mx-5">
        <button
          class="appearance-none bg-gray-900 border-2 border-gray-300 px-3 py-2 rounded-lg hover:border-orange-500 hover:text-orange-500 hover:shadown"
          type="button"
          title="Novo contato"
        >
          <span class="mdi mdi-plus"></span> Contato
        </button>
      </div>
      <div class="mx-5">
        <button
          class="appearance-none bg-gray-900 border-2 border-gray-300 px-3 py-2 rounded-lg hover:border-orange-500 hover:text-orange-500 hover:shadown"
          type="button"
          title="Nova reunião"
        >
          <span class="mdi mdi-plus"></span> Reunião
        </button>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "QuickActions"
  }
</script>

<style scoped>

</style>
