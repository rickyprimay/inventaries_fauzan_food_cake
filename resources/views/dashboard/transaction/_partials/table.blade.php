<div class="max-w-full overflow-x-auto">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Nama Produk</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Nama Outlet</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Tipe Transaksi</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Quantity</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Tanggal Transaksi</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Deskripsi</th>
              <th class="px-4 py-4 font-medium text-black">Aksi</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($transactions as $transaction)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $transaction->products->product_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $transaction->outlets->outlet_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                    @php
                        $statusClass = match($transaction->transactions_type) {
                            'masuk' => 'bg-success bg-opacity-10 text-success',
                            'keluar' => 'bg-danger bg-opacity-10 text-danger',
                            'retur' => 'bg-primary bg-opacity-10 text-primary',
                            'waste' => 'bg-warning bg-opacity-10 text-warning',
                        };
                    @endphp
                    <p class="inline-flex rounded-full px-3 py-1 text-sm font-medium {{ $statusClass }}">
                      {{ ucfirst($transaction->transactions_type) }}
                    </p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $transaction->quantity }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ \Carbon\Carbon::parse($transaction->date)->translatedFormat('j M Y') }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black truncate max-w-[200px] cursor-pointer hover:text-blue-500"
                         data-modal-target="desc-modal-{{ $transaction->id }}"
                         data-modal-toggle="desc-modal-{{ $transaction->id }}">
                         {{ text_limiter($transaction->description) }}
                      </p>
                  </td>                
                  <td class="border-b px-4 py-5">
                      <div class="flex items-center space-x-3.5">
                        @if ($isAdmin == true)
                          <button data-modal-target="edit-transaction-modal-{{ $transaction->id }}" data-modal-toggle="edit-transaction-modal-{{ $transaction->id }}" class="hover:text-primary" >
                              <i class="fa-solid fa-pencil text-blue-500"></i>
                          </button>
                          <button data-modal-target="transaction-delete-modal-{{ $transaction->id }}" data-modal-toggle="transaction-delete-modal-{{ $transaction->id }}" class="hover:text-primary">
                              <i class="fas fa-trash-alt text-red-500"></i>
                          </button>
                        @elseif ($isPIC == true)
                          <button data-modal-target="transaction-delete-modal-{{ $transaction->id }}" data-modal-toggle="transaction-delete-modal-{{ $transaction->id }}" class="hover:text-primary">
                              <i class="fas fa-trash-alt text-red-500"></i>
                          </button>
                        @endif
                      </div>
                  </td>
              </tr>
              <div id="desc-modal-{{ $transaction->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow">
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                      <h3 class="text-xl font-semibold text-gray-900">
                        Deskripsi Produk
                      </h3>
                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="desc-modal-{{ $transaction->id }}">
                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 0 1 1.414 0L10 8.586l4.293-4.293a1 1 0 1 1 1.414 1.414L11.414 10l4.293 4.293a1 1 0 1 1-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 0 1-1.414-1.414L8.586 10 4.293 5.707a1 1 0 0 1 0-1.414z" clip-rule="evenodd"/></svg>
                      </button>
                    </div>
                    <div class="p-6 space-y-6">
                      <p class="text-base leading-relaxed text-gray-500">
                        {{ $transaction->description }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              @include('dashboard.transaction._partials.delete-modal', ['transaction' => $transaction])
          @empty
              <tr>
                  <td colspan="6" class="text-center px-4 py-5 text-gray-500">
                      Tidak ada Transaksi.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $transactions->links() }}
</div>