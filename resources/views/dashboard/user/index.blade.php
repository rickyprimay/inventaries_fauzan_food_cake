<x-layout>
  <div class="p-8">
    
    <div class="flex justify-between items-center mb-4">
      <h1 class="font-bold text-black text-2xl">Manajemen User</h1>
      <button
        data-modal-target="add-user-modal"
        data-modal-toggle="add-user-modal"
        type="button"
        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
        Tambah User
      </button>
    </div>

    <div class="flex justify-start items-center gap-2 mb-4">
      <form method="GET" action="{{ route('user') }}" class="flex items-center gap-2 flex-wrap">
        
        <select
          id="roleFilter"
          name="role"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5 pr-6">
          <option value="">Pilih Role</option>
          <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
          <option value="PIC" {{ request('role') == 'PIC' ? 'selected' : '' }}>PIC</option>
          <option value="Staff" {{ request('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
        </select>

        <input
          type="text"
          name="search"
          value="{{ request('search') }}"
          placeholder="Cari Nama User"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 p-2.5" />

        <button
          type="submit"
          class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
          Cari
        </button>
      </form>

      <a
        href="{{ route('user') }}"
        class="text-gray-600 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2">
        Reset
      </a>
    </div>

    @include('dashboard.user._partials.table')

    @include('dashboard.user._partials.add-modal')

    @foreach ($users as $user)
      @include('dashboard.user._partials.edit-modal')
    @endforeach

  </div>
</x-layout>