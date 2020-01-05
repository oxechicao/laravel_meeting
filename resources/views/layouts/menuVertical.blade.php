<div class="flex flex-col bg-gray-900 w-32 shadow-2xl invisible md:visible h-full">
  <div class="logo-ms">
    <a href="{{ route('home') }}">
      <p class="text-4xl text-center text-orange-600 font-bold my-5 mx-5  hover:text-orange-500 hover:shadow-2xl">
        MS
      </p>
    </a>
  </div>
  <div class="mt-6 my-app-menu text-gray-600 text-center font-bold h-full">
    <div class="my-6 hover:text-gray-300">
      <span class="text-5xl mdi mdi-home-outline"></span>
      <p class="text-icon-menu">Home</p>
    </div>
    <div class="my-6 hover:text-gray-300">
      <span class="text-5xl mdi mdi-account-group-outline"></span>
      <p class="text-icon-menu">Contatos</p>
    </div>
    <div class="my-6 hover:text-gray-300">
      <span class="text-5xl mdi mdi-calendar-outline"></span>
      <p class="text-icon-menu">Agenda</p>
    </div>
    <div class="my-6 hover:text-gray-300">
      <a href="{{route('user.index')}}">
        <span class="text-5xl mdi mdi-settings-outline"></span>
        <p class="text-icon-menu">Perfil</p>
      </a>
    </div>
  </div>
  <div class="mt-6 mb-4 my-app-menu text-gray-600 text-center font-bold">
    <form
      action="{{route('logout')}}"
      method="post"
      class="w-full"
    >
      @csrf
      <button class="appearance-none text-center text-gray-600 font-bold hover:text-gray-400 hover:shadow-2xl">
        <span class="text-2xl mdi mdi-exit-run"></span>
        <span class="text-xl">Sair</span>
      </button>
    </form>
  </div>
</div>
