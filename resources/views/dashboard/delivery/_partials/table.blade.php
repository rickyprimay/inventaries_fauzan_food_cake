<div class="max-w-full overflow-x-auto">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[50px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Dari Outlet</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Ke Outlet</th>
              <th class="min-w-[200px] px-4 py-4 font-medium text-black">
                  <div class="flex items-center space-x-2">
                      <span>Tanggal Pengiriman</span>
                      <form method="GET" action="{{ route('delivery') }}">
                          <button type="submit" name="sort" value="{{ request('sort') === 'asc' ? 'desc' : 'asc' }}" class="text-gray-600 hover:text-black">
                              @if (request('sort') === 'asc')
                                  <i class="fa-solid fa-arrow-up-wide-short"></i>
                              @else
                                  <i class="fa-solid fa-arrow-down-wide-short"></i>
                              @endif
                          </button>
                      </form>
                  </div>
              </th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Status Pengiriman</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Detail Pengiriman</th>
              <th class="px-4 py-4 font-medium text-black">Aksi</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($deliveries as $delivery)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ ($deliveries->currentPage() - 1) * $deliveries->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $delivery->fromOutlet->outlet_name ?? '-' }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $delivery->toOutlet->outlet_name ?? '-' }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ \Carbon\Carbon::parse($delivery->send_date)->translatedFormat('j M Y') }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      @php
                          $statusClass = match($delivery->send_status) {
                              'diterima' => 'bg-success bg-opacity-10 text-success',
                              'pending' => 'bg-danger bg-opacity-10 text-danger',
                              'dikirim' => 'bg-warning bg-opacity-10 text-warning',
                              default => 'bg-gray-200 text-gray-700',
                          };
                      @endphp
                      <p class="inline-flex rounded-full px-3 py-1 text-sm font-medium {{ $statusClass }}">
                          {{ ucfirst($delivery->send_status) }}
                      </p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <a href="{{ route('delivery.detail', $delivery->id) }}" class="text-black hover:text-yellow-500"><i class="fa-solid fa-eye"></i> Lihat Detail Pengiriman</a>
                  </td>
                  <td class="border-b px-4 py-5">
                      <div class="flex items-center space-x-3.5">
                        @if ($isAdmin = true)
                          <button data-modal-target="edit-delivery-modal-{{ $delivery->id }}" data-modal-toggle="edit-delivery-modal-{{ $delivery->id }}" class="hover:text-primary">
                              <i class="fa-solid fa-pencil text-blue-500"></i>
                          </button>
                          <button data-modal-target="delivery-delete-modal-{{ $delivery->id }}" data-modal-toggle="delivery-delete-modal-{{ $delivery->id }}" class="hover:text-primary">
                              <i class="fas fa-trash-alt text-red-500"></i>
                          </button>
                        @elseif ($isPIC = true)
                          <button data-modal-target="delivery-delete-modal-{{ $delivery->id }}" data-modal-toggle="delivery-delete-modal-{{ $delivery->id }}" class="hover:text-primary">
                              <i class="fas fa-trash-alt text-red-500"></i>
                          </button>
                        @endif
                      </div>
                  </td>
              </tr>
              @include('dashboard.delivery._partials.delete-modal', ['delivery' => $delivery])
          @empty
              <tr>
                  <td colspan="6" class="text-center px-4 py-5 text-gray-500">
                      Tidak ada Pengiriman.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $deliveries->links() }}
</div>
