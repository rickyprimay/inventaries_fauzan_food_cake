<x-layout>
  <div class="p-8">
    <div class="flex justify-between">
        <h1 class="text-black font-bold text-2xl mb-4">Pengiriman</h1>
        <button data-modal-target="add-delivery-modal" data-modal-toggle="add-delivery-modal" type="button"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">
            Tambah Pengiriman
        </button>
    </div>

    <div class="flex justify-start mb-4">

      <form method="GET" action="{{ route('delivery') }}" class="flex items-center gap-2">
        <select id="statusFilter" name="send_status"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5 pr-6">
            <option value="">Pilih Status</option>
            <option value="pending">Pending</option>
            <option value="dikirim">Dikirim</option>
            <option value="diterima">Diterima</option>
        </select>

        <button type="submit"
            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
            Cari
        </button>
      </form>
    </div>

    @include('dashboard.delivery._partials.table')

    @include('dashboard.delivery._partials.add-modal')
    @foreach ($deliveries as $delivery)
      @include('dashboard.delivery._partials.edit-modal')
    @endforeach

  </div>
</x-layout>