<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <!-- CSRF Token -->
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script
        src="{{ asset('js/app.js') }}"
        defer
    ></script>
    <script
        src="{{ asset('js/formHome.js') }}"
        defer
    ></script>

    <!-- Fonts -->
    <link
        rel="dns-prefetch"
        href="//fonts.gstatic.com"
    >
    <link
        href="https://fonts.googleapis.com/css?family=Nunito"
        rel="stylesheet"
    >

    <!-- Styles -->
    <link
        href="{{ asset('css/app.css') }}"
        rel="stylesheet"
    >
    <link
        href="{{ asset('css/tailwind.css') }}"
        rel="stylesheet"
    >
</head>
<body>
<div id="app">
    <div class="flex w-full h-screen justify-center content-center bg-gray-100">
        <div class="flex flex-col  w-full md:w-1/2 justify-center">
            <div class="h-auto ml-0 md:ml-16 md:mr-16 px-8 pt-6 pb-8 mb-4  rounded-lg  shadow-2xl">
                <p class="text-5xl text-orange-600 font-bold">
                    Meeting Scheduler
                </p>
                <p class="text-3xl text-gray-500 font-bold">
                    Desejamos boas vindas à você.
                </p>
                <p class="text-gray-500 font-bold">
                    Preencha os dados para acessar.
                </p>
                <form
                    id="form-home"
                    action=""
                    method="post"
                    class="mt-10 px-5"
                >
                    <div class="mb-10">
                        <label
                            for="email"
                            class="block text-gray-700"
                        >
                            E-mail
                        </label>
                        <input
                            class="mt-3 shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                            id="email"
                            type="email"
                            placeholder="email@provedor.com"
                            required
                        >
                    </div>
                    <div class="mb-10">
                        <label
                            for="password"
                            class="block text-gray-700"
                        >
                            Senha
                        </label>
                        <input
                            class="mt-3 shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                            id="password"
                            type="password"
                            required
                        >
                    </div>
                    <div class="flex mb-5 justify-between">
                        <button
                            id="form-buttom-register"
                            type="button"
                            class="appearance-none inline-block align-baseline self-center text-right font-bold text-sm text-orange-500 hover:text-orange-700"
                            href="#"
                        >
                            Primeira vez? Cadastre-se!
                        </button>
                        <button
                            id="form-button-login"
                            type="button"
                            class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none"
                            type="button"
                        >
                            Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div
            class="flex flex-col justify-center w-0 md:w-2/3 home-image-form shadow-2xl"
        ></div>

    </div>
</div>
</div>
</body>
</html>
