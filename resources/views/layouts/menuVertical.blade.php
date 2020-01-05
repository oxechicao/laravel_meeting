<div class="flex flex-col bg-gray-900 w-32 shadow-2xl invisible md:visible h-full">
    <div class="logo-ms">
        <a href="{{ route('home') }}">
            <p class="text-4xl text-center text-orange-600 font-bold my-5 mx-5  hover:text-orange-500 hover:shadow-2xl">
                MS
            </p>
        </a>
        <form action="{{route('logout')}}" method="post" class="w-full flex justify-center">
            @csrf
            <button class="appearance-none text-center text-gray-600 font-bold hover:text-gray-400 hover:shadow-2xl mx-5">
                <span class="text-lg mdi mdi-exit-run"></span> Sair
            </button>
        </form>
    </div>
    <div class="mt-6 my-app-menu text-gray-600 text-center font-bold">
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
            <span class="text-5xl mdi mdi-settings-outline"></span>
            <p class="text-icon-menu">Perfil</p>
        </div>
    </div>
</div>
