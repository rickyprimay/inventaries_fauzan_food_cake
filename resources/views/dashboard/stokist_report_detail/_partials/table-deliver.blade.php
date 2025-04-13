<div class="max-w-full overflow-x-auto mb-4">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Kirim ke Outlet</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Tanggal</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Status Pengiriman</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($deliverDetails as $delivery)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $delivery->delivery->toOutlet->outlet_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ \Carbon\Carbon::parse($delivery->date)->translatedFormat('j M Y') }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                    @php
                        $statusClass = match($delivery->delivery->send_status) {
                            'diterima' => 'bg-success bg-opacity-10 text-success',
                            'pending' => 'bg-danger bg-opacity-10 text-danger',
                            'dikirim' => 'bg-warning bg-opacity-10 text-warning',
                            default => 'bg-gray-200 text-gray-700',
                        };
                    @endphp
                    <p class="inline-flex rounded-full px-3 py-1 text-sm font-medium {{ $statusClass }}">
                        {{ ucfirst($delivery->delivery->send_status) }}
                    </p>
                  </td>
              </tr>
          @empty
              <tr>
                  <td colspan="6" class="text-center px-4 py-5 text-gray-500">
                      Tidak ada Produk di Laporan Stokist ini.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

