<template>
<div class="flex">
  <div class="flex flex-col">
    <div>
      <label :for="`title-${randomId}`">Titulo</label>
      <input
        :id="`title-${randomId}`"
        type="text"
      >
    </div>
    <div>
      <label :for="`description-${randomId}`">Descrição</label>
      <textarea
        name="description-agenda"
        :id="`description-${randomId}`"
        cols="30"
        rows="5"
      />
    </div>
  </div>
  <div class="flex flex-col">
    <div class="flex justify-between">
      <p>Participantes</p>
      <span class="mdi mdi-plus"></span>
    </div>
  </div>
</div>
</template>

<script>
export default {
  name: 'AgendaForm',
  computed: {
    randomId () {
      return 'form-agenda-' + (Math.random() * 1000 + Math.random() * 100)
    }
  }
}
</script>

<style scoped>

</style>
