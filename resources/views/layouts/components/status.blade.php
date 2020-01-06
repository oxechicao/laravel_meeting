@if (session('status'))
  <div
    class="bg-green-300 border-4 border-green-500 text-green-900 px-10 my-5 py-1 rounded-lg mx-16 flex items-center"
    role="alert"
  >
    <span class="mdi mdi-thumb-up-outline mr-10 text-xl"></span> {{ session('status') }}
  </div>
@endif
