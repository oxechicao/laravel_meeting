@extends('layouts.app')

@section('content')
  <div class="flex flex-col h-full mb-16 md:mt-0 w-full max-w-full">
    <div class="mt-16 pl-16">
      <div class="text-4xl text-gray-700 flex">Agenda de Reuniões <agenda-page-help/></div>
    </div>

    @include('layouts.components.errors')
    @include('layouts.components.status')

    <div class="mt-16 pl-16 flex flex-col w-full max-w-full">
      <agenda-index
        class="w-full"
        :actions="{{ $actions->toJson() }}"
      ></agenda-index>
    </div>
  </div>
@endsection
