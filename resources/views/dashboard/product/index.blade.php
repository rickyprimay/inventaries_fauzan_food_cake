<x-layout>
  <div class="p-8">
    <div class="flex justify-between">
        <h1 class="text-black font-bold text-2xl mb-4">Produk</h1>
        <button data-modal-target="add-product-modal" data-modal-toggle="add-product-modal" type="button"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
            Tambah Produk
        </button>
    </div>

    @include('dashboard.product._partials.table')

    @include('dashboard.product._partials.add-modal')
    @foreach ($products as $product)
      @include('dashboard.product._partials.edit-modal')
    @endforeach

  </div>
</x-layout>