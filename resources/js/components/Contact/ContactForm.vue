<template>
  <div class="w-full">
    <div
      v-if="showAlert"
      class="mb-5 px-5 py-2 bg-green-200 border-2 border-green-700 text-green-700 rounded-lg flex justify-between"
    >
      <div>
        <span class="mdi mdi-thumb-up-outline mr-10"></span> Salvo com sucesso
      </div>
      <div>
        <button @click="showAlert = false">
          <span class="mdi mdi-close"></span>
        </button>
      </div>
    </div>
    <div class="flex flex-col mb-8">
      <label
        class="text-lg mb-2"
        for="contact-name"
      >Nome</label>
      <input
        type="text"
        name="name"
        id="contact-name"
        class="bg-gray-100 p-2 text-black rounded border-2 focus:bg-gray-200 focus:shadown"
        v-model="$v.localContact.name.$model"
        :class="{'border border-red-500': $v.localContact.name.$anyDirty && !$v.localContact.name.required}"
      >
      <p class="text-gray-500 italic text-sm">* Obrigatório</p>
    </div>
    <div class="flex flex-col mb-8">
      <label
        class="text-lg mb-2"
        for="contact-email"
      >E-mail</label>
      <input
        v-model="$v.localContact.email.$model"
        type="email"
        name="email"
        id="contact-email"
        class="bg-gray-100 p-2 text-black rounded border-2 focus:bg-gray-200 focus:shadown"
        :class="{'border border-red-500': $v.localContact.email.$anyDirty && (!$v.localContact.email.required || !$v.localContact.email.maxLength)}"
      >
      <p class="text-gray-500 italic text-sm">* Obrigatório</p>
    </div>
    <div class="flex flex-col mb-8">
      <div class="mb-2 flex justify-between content-center">
        <label
          class="text-lg"
          for="contact-email"
        >Telefones</label>
        <button
          @click="countPhones++"
          type="button"
          class="text-gray-900 hover:text-gray-700 px-4 font-bold rounded-lg"
        >
          <span class="mdi mdi-plus"></span>
        </button>
      </div>
      <div
        class="mb-5 w-full"
        v-for="count in countPhones"
        :key="count"
      >
        <div class="flex justify-between">
          <input
            type="text"
            name="phone[]"
            id="contact-phone"
            class="bg-gray-100 p-2 text-black rounded border-2 focus:bg-gray-200 focus:shadown w-full"
            v-model="localContact.phones[count -1]"
            v-mask="'(##) # ####-#####'"
          >
          <button
            @click="removePhone(count -1)"
            type="button"
            class="text-gray-900 hover:text-gray-700 px-4 font-bold rounded-lg"
          >
            <span class="mdi mdi-delete-outline"></span>
          </button>
        </div>
      </div>
    </div>
    <div class="flex justify-between">
      <button
        @click="handleDelete"
        class="text-orange-700 hover:text-orange-500 hover:shadown"
      >
        <span v-if="this.contact.hasOwnProperty('id')">
        <span class="mdi mdi-delete"></span> Remover
        </span>
      </button>
      <button
        @click="submitForm"
        class="px-6 py-2 bg-orange-600 hover:bg-orange-500 hover:shadown-lg flex items-center rounded-lg text-gray-200 font-bold"
        type="button"
      >
        Salvar
      </button>
    </div>
    <contact-remove-confirm
      :contact="contact"
      :showModal="showModal"
      @delete="deleteForm"
      @close="showModal = false"
    />
  </div>
</template>

<script>
  import {required, maxLength} from 'vuelidate/lib/validators'

  export default {
    name: "ContactForm",
    props: {
      contact: {
        required: true
      },
      actions: {
        required: true
      }
    },
    data () {
      return {
        countPhones: 1,
        localContact: {name: '', email: '', phones: []},
        showAlert: false,
        showModal: false
      }
    },
    validations: {
      localContact: {
        name: {required, maxLength: 255},
        email: {required, maxLength: 255}
      }
    },
    watch: {
      contact () {
        this.localContact = JSON.parse(JSON.stringify(this.contact))
      }
    },
    mounted () {
      this.$v.$reset()
      this.countPhones = this.contact.phones.length
      this.localContact = JSON.parse(JSON.stringify(this.contact))
    },
    computed: {
      action () {
        return this.contact.hasOwnProperty('id') ? this.actions[1] + '/' + this.contact.id : this.actions[0]
      }
    },
    methods: {
      removePhone (index) {
        this.localContact.phones.splice(index, 1)
        this.countPhones = this.localContact.phones.length
      },
      submitForm () {
        this.$v.$touch()
        if (this.$v.$invalid) return

        if (this.contact.hasOwnProperty('id')) return this.putForm()

        return this.postForm()
      },
      putForm () {
        window.axios.put(this.action, this.localContact)
          .then(res => {
            console.log(res)
            this.showAlert = true
            setTimeout(() => {
              this.showAlert = false
            }, 5000)
            this.$emit('findContacts')
          })
          .catch(err => {
            console.log(err)
          })
      },
      postForm () {
        window.axios.post(this.action, this.localContact)
          .then(res => {
            console.log(res)
            this.showAlert = true
            setTimeout(() => {
              this.showAlert = false
            }, 5000)
            this.$emit('findContacts')
          })
          .catch(err => {
            console.log(err)
          })
      },
      handleDelete () {
        this.showModal = true
      },
      deleteForm () {
        if (!this.contact.hasOwnProperty('id')) return
        window.axios.delete(this.actions[2] + '/' + this.contact.id)
          .then(() => this.$emit('findContacts'))
      }
    }
  }
</script>

<style scoped>

</style>
