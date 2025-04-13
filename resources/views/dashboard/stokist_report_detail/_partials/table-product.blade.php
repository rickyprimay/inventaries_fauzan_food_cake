<div class="max-w-full overflow-x-auto mb-4">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Nama Produk</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Quantity</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Tanggal</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($productDetails as $product)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $product->product->product_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $product->quantity }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ \Carbon\Carbon::parse($product->date)->translatedFormat('j M Y') }}</p>
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

