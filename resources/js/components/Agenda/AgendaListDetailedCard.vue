<template>
  <div class="flex w-full h-full">
    <div class="w-64 text-center h-full">
      <p class="text-6xl text-orange-600 font-bold">
        {{ meeting.date.getDate() }}
      </p>
      <p class="text-lg text-orange-500 font-bold italic">
        {{ meeting.date.toLocaleString('pt-BR', {year: 'numeric', month: 'long'}) }}
      </p>
      <p class="text-lg text-orange-500 font-bold">
        {{ meeting.hour }}
      </p>
    </div>
    <div class="flex flex-wrap w-full h-full">
      <div class="flex flex-col w-full h-full md:w-3/5">
        <p class="text-2xl">{{ meeting.title }}</p>
        <p class="overflow-y-auto h-32">{{meeting.description}}</p>
      </div>
      <div class="w-full h-full md:w-2/5 flex ">
        <div class="flex flex-wrap justify-between w-full h-full">
          <div class="w-auto">
            <p>Participantes:</p>
            <div class="overflow-auto w-full">
              <span v-for="(participant, idp) in meeting.participants">
                {{participant}}
              </span>
            </div>
          </div>
          <div class="w-10 h-full mx-3 flex flex-col">
            <button
              class="btn-action"
              @click="showModal = true"
            >
              <span class="mdi mdi-pencil"></span>
            </button>
            <button
              @click="showModalRemove = true"
              class="btn-action"
            >
              <span class="mdi mdi-delete"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <agenda-form-modal
      @close="showModal = false"
      @getAgendas="$emit('getAgendas')"
      :actions="actions"
      :show-modal="showModal"
      :agenda-prop="meeting"
    />
    <agenda-remove-confirm
      @close="showModalRemove = false"
      @getAgendas="$emit('getAgendas')"
      :showModal="showModalRemove"
      :agenda="meeting"
      :action="actions.destroy"
    />
  </div>
</template>

<script>
  export default {
    name: "AgendaListDetailedCard",
    props: {
      actions: {
        required: true
      },
      meeting: {
        required: true
      }
    },
    data () {
      return {
        showModal: false,
        showModalRemove: false
      }
    }
  }
</script>

<style
  lang="scss"
  scoped
>
  .btn-action {
    @apply text-xl text-gray-700;
  }

  .btn-action:hover {
    @apply text-orange-600;
  }

</style>
