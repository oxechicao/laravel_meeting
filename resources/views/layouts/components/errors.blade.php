@if ($errors->any())
  <div
    class="bg-red-300 border-4 border-red-500 text-red-900 px-10 my-5 py-1 rounded-lg mx-16 flex items-center"
    role="alert"
  >
    <span class="mdi mdi-close-octagon-outline mr-10 text-xl"></span>
    @foreach ($errors->all() as $error)
      <span class="mr-3">{{ $error }}</span>
    @endforeach
  </div>
@endif
