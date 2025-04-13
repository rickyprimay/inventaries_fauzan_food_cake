<div class="max-w-full overflow-x-auto mb-4">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Produk Transaksi</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Tipe Transaksi</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Quantity</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Tanggal</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($transactionDetails as $transaction)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $transaction->transactions->products->product_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ ucfirst($transaction->transactions->transactions_type) }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $transaction->transactions->quantity }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ \Carbon\Carbon::parse($transaction->date)->translatedFormat('j M Y') }}</p>
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

