<div class="max-w-full overflow-x-auto">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Nama Produk</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Tanggal Input</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Kategori</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Satuan</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Stok</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Harga</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Deskripsi</th>
              <th class="px-4 py-4 font-medium text-black">Aksi</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($products as $product)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $product->product_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ \Carbon\Carbon::parse($product->date_input)->translatedFormat('j M Y') }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $product->category->category_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $product->unit }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black"> {{ $product->stock == 0 ? 'Habis' : $product->stock }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ rupiah($product->price) }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black truncate max-w-[200px] cursor-pointer hover:text-blue-500"
                         data-modal-target="desc-modal-{{ $product->id }}"
                         data-modal-toggle="desc-modal-{{ $product->id }}">
                         {{ text_limiter($product->description) }}
                      </p>
                  </td>                
                  <td class="border-b px-4 py-5">
                      <div class="flex items-center space-x-3.5">
                        @if ($isAdmin == true)
                            <button data-modal-target="edit-product-modal-{{ $product->id }}" data-modal-toggle="edit-product-modal-{{ $product->id }}" class="hover:text-primary" >
                                <i class="fa-solid fa-pencil text-blue-500"></i>
                            </button>
                            <button data-modal-target="product-delete-modal-{{ $product->id }}" data-modal-toggle="product-delete-modal-{{ $product->id }}" class="hover:text-primary">
                                <i class="fas fa-trash-alt text-red-500"></i>
                            </button>
                        @elseif ($isPIC == true)
                            <button data-modal-target="product-delete-modal-{{ $product->id }}" data-modal-toggle="product-delete-modal-{{ $product->id }}" class="hover:text-primary">
                                <i class="fas fa-trash-alt text-red-500"></i>
                            </button>
                        @endif
                      </div>
                  </td>
              </tr>
              <div id="desc-modal-{{ $product->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow">
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                      <h3 class="text-xl font-semibold text-gray-900">
                        Deskripsi Produk
                      </h3>
                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="desc-modal-{{ $product->id }}">
                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 0 1 1.414 0L10 8.586l4.293-4.293a1 1 0 1 1 1.414 1.414L11.414 10l4.293 4.293a1 1 0 1 1-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 0 1-1.414-1.414L8.586 10 4.293 5.707a1 1 0 0 1 0-1.414z" clip-rule="evenodd"/></svg>
                      </button>
                    </div>
                    <div class="p-6 space-y-6">
                      <p class="text-base leading-relaxed text-gray-500">
                        {{ $product->description }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              @include('dashboard.product._partials.delete-modal', ['product' => $product])
          @empty
              <tr>
                  <td colspan="6" class="text-center px-4 py-5 text-gray-500">
                      Tidak ada Produk.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $products->links() }}
</div>
