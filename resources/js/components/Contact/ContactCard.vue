<template>
  <div class="mr-5">

    <div class="w-full p-10 bg-gray-100 rounded-lg shadow-lg">
      <contact-form
        :contact="contact"
        :actions="actions"
      />
    </div>
  </div>
</template>

<script>
  export default {
    name: "ContactCard",
    props: {
      contact: {
        required: true
      },
      actions: {
        required: true
      }
    }
  }
</script>

<style scoped>

</style>
