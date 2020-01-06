@extends('layouts.app')

@section('content')
  <div class="flex flex-col h-full mb-16 md:mt-0 w-full">
    <div class="mt-16 ml-16">
      <p class="text-4xl text-gray-700">Perfil</p>
    </div>

    @include('layouts.components.errors')
    @include('layouts.components.status')

    @if(data_get($user, 'name', '') === 'MS Guest')
      <div class="bg-blue-300 border-4 border-blue-500 text-blue-900 px-10 py-1 my-5 rounded-lg mx-16 flex items-center">
        <span class="mdi mdi-alert-circle-outline mr-10 text-xl"></span> Você ainda não alterou seu nome.
        Altere os dados no formulário abaixo.
      </div>
    @endif

    <div class="mt-16 flex flex-col  w-full">
      <div class="flex w-full">
        <div class="w-1/4 md:w-1/5 px-4 md:px-10 text-right border-r-4 text-lg font-bold">
          Informações da conta
        </div>
        <div class="px-4 md:px-10 flex flex-col">
          <form
            action="{{ route('user.update', ['id' => $user->id]) }}"
            method="post"
          >
            @method('PUT')
            @csrf

            <div class="w-auto">
              <label
                for="form-customer-name"
                class="text-lg"
              >
                Nome
              </label>
            </div>
            <div class="w-full my-2">
              <input
                required
                class="shadow appearance-none border rounde py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                name="name"
                id="form-customer-name"
                value="{{ data_get($user, 'name', '') }}"
              />
            </div>
            <div class="mt-5 w-auto">
              <label
                for="form-customer-email"
                class="text-lg"
              >
                E-mail
              </label>
            </div>
            <div class="w-full my-2">
              <input
                required
                type="email"
                class="shadow appearance-none border rounde py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                name="email"
                id="form-customer-email"
                value="{{ data_get($user, 'email', '') }}"
              />
            </div>

            <div class="mt-5 w-auto">
              <label
                for="form-customer-password"
                class="text-lg"
              >
                Senha
              </label>

            </div>
            <div class="w-full my-2">
              <input
                type="password"
                class="shadow appearance-none border rounde py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                name="password"
                id="form-customer-password"
                value=""
              />
            </div>

            <div class="mt-5 w-auto">
              <label
                for="form-customer-password"
                class="text-lg"
              >
                Confirmação de Senha
              </label>

            </div>
            <div class="w-full my-2">
              <input
                type="password"
                class="shadow appearance-none border rounde py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                name="password_confirmation"
                id="form-customer-password"
                value=""
              />
            </div>

            <div class="w-full mt-10 text-right">
              <button
                id="form-customer-button-save"
                class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none mb-5"
              >
                Salvar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
