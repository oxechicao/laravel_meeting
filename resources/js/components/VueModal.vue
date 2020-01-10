<template>
<transition
  name="vue-modal-fade-transition"
  enter-active-class="animated fadeIn faster"
  leave-active-class="animated fadeOut faster"
>
  <div
    v-if="showModal"
    class="modal-mask overflow-auto bg-gray-100"
  >
    <div class="modal-wrapper px-5 md:px-0">
      <div class="modal-container w-full md:w-1/2 lg:w-1/3 rounded-lg overflow-y-auto max-h-screen">

        <div class="modal-header text-orange-700 bg-gray-100 py-5 px-5 text-xl">
          <div class="flex justify-between">
            <div>
              <slot name="header">
              </slot>
            </div>
            <div>
              <button
                type="button"
                @click="$emit('close')"
              ><span class="mdi mdi-close hover:text-orange-800 hover:shadown"></span>
              </button>
            </div>
          </div>
        </div>

        <div class="modal-body px-10 py-5 bg-gray-100">
          <slot name="body">
          </slot>
        </div>

        <div class="modal-footer px-10 py-5 bg-gray-100">
          <slot name="footer">
          </slot>
        </div>
      </div>
    </div>
  </div>
</transition>
</template>

<script>
export default {
  name: 'VueModal',
  props: ['showModal'],
  computed: {
    modalId () {
      return 'modal-' + ((Math.random() * 10000 + Math.random() * 1000) * Math.random())
    }
  }
}
</script>

<style scoped>
  .modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
  }

  .modal-wrapper {
    display: table-cell;
    vertical-align: middle;

  }

  .modal-container {
    margin: 0px auto;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
    font-family: Helvetica, Arial, sans-serif;
  }

  .modal-header h3 {
    margin-top: 0;
    color: #42b983;
  }
</style>
