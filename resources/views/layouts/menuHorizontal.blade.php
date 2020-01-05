<div class="flex bg-gray-900 shadow-2xl w-full">
    <div class="logo-ms flex items-center">
        <a href="{{ route('home') }}">
            <p class="text-center text-orange-600 font-bold my-5 mx-5 hover:text-orange-500 hover:shadow-2xl">
                MS
            </p>
        </a>
    </div>
    <div class="flex flex-wrap justify-around items-center w-full my-app-menu text-gray-600 text-center font-bold">
        <div class="hover:text-gray-300 mx-5">
            <span class="text-2xl mdi mdi-home-outline"></span>
            <p class="text-icon-menu-h">Home</p>
        </div>
        <div class="hover:text-gray-300 mx-5">
            <span class="text-2xl mdi mdi-account-group-outline"></span>
            <p class="text-icon-menu-h">Contatos</p>
        </div>
        <div class="hover:text-gray-300 mx-5">
            <span class="text-2xl mdi mdi-calendar-outline"></span>
            <p class="text-icon-menu-h">Agenda</p>
        </div>
        <div class="hover:text-gray-300 mx-5">
            <span class="text-2xl mdi mdi-settings-outline"></span>
            <p class="text-icon-menu-h">Perfil</p>
        </div>

        <div class="hover:text-gray-300 mx-5">
            <form action="{{route('logout')}}" method="post" class="w-full">
                @csrf
                <button class="appearance-none">
                <span class="text-2xl mdi mdi-exit-run"></span>
                    <p class="text-icon-menu-h">Sair</p>
                </button>
            </form>
        </div>
    </div>
</div>
