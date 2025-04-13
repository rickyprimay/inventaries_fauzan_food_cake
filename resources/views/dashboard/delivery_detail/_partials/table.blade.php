<div class="max-w-full overflow-x-auto">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[50px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Produk</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Quantity</th>
              @if ($isFromOutletId == true && $delivery->send_status != 'diterima')
                <th class="px-4 py-4 font-medium text-black">Aksi</th>
              @endif  
          </tr>
      </thead>
      <tbody>
          @forelse ($detailDeliveries as $detail)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ ($detailDeliveries->currentPage() - 1) * $detailDeliveries->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $detail->product->product_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $detail->quantity }}</p>
                  </td>
                  @if ($isFromOutletId == true && $delivery->send_status != 'diterima')
                    <td class="border-b px-4 py-5">
                        <div class="flex items-center space-x-3.5">
                          @if ($isAdmin == true )
                            <button data-modal-target="edit-delivery-modal-{{ $detail->id }}" data-modal-toggle="edit-delivery-modal-{{ $detail->id }}" class="hover:text-primary">
                                <i class="fa-solid fa-pencil text-blue-500"></i>
                            </button>
                            <button data-modal-target="delivery-delete-modal-{{ $detail->id }}" data-modal-toggle="delivery-delete-modal-{{ $detail->id }}" class="hover:text-primary">
                                <i class="fas fa-trash-alt text-red-500"></i>
                            </button>
                          @elseif ($isPIC == true)
                            <button data-modal-target="delivery-delete-modal-{{ $detail->id }}" data-modal-toggle="delivery-delete-modal-{{ $detail->id }}" class="hover:text-primary">
                                <i class="fas fa-trash-alt text-red-500"></i>
                            </button>
                          @endif
                        </div>
                    </td>
                  @endif
              </tr>
              @include('dashboard.delivery_detail._partials.delete-modal', ['delivery' => $detail])
          @empty
              <tr>
                  <td colspan="6" class="text-center px-4 py-5 text-gray-500">
                      Belum ada barang yang dikirim.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $detailDeliveries->links() }}
</div>
