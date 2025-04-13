<x-layout>
  <div class="p-8">
    <div class="flex justify-between">
        <h1 class="text-black font-bold text-2xl mb-4">Transaksi</h1>
        <button data-modal-target="add-transaction-modal" data-modal-toggle="add-transaction-modal" type="button"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            Tambah Transaksi
        </button>
    </div>

    @include('dashboard.transaction._partials.table')

    @include('dashboard.transaction._partials.add-modal')
    @foreach ($transactions as $transaction)
      @include('dashboard.transaction._partials.edit-modal')
    @endforeach

  </div>
</x-layout>