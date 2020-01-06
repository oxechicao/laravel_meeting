@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div
            class="alert alert-success"
            role="alert"
        >
            {{ session('status') }}
        </div>
    @endif

    <div class="flex flex-col w-full sm:h-auto mb-16 md:mt-0">
        <div class="mt-16 ml-16">
            <p class="text-4xl text-gray-700">Próximas reuniões</p>
        </div>
        <div class="mt-16 mx-16">
            {{--        <span class="mdi mdi-emoticon-sad-outline"></span>--}}
            <card-meeting></card-meeting>
        </div>
    </div>
    <div class="flex flex-col w-full h-full  min-h-screen md:w-2/6 bg-gray-900 items-center">
        <div class="mx-16 md:mx-10 flex flex-col items-center mt-16 w-full h-full">
            <right-sidebar></right-sidebar>
        </div>
    </div>
@endsection
