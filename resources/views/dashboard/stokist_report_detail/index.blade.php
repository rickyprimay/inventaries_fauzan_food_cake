<x-layout>
  <div class="p-8">
      <div class="flex justify-between mb-2">
          <h1 class="text-black font-bold text-2xl">Detail Laporan Rentang dari {{ \Carbon\Carbon::parse($stokistReport->report_date_start)->translatedFormat('j M Y') }} - {{ \Carbon\Carbon::parse($stokistReport->report_date_end)->translatedFormat('j M Y') }} </h1>
      </div>

      <div class="flex justify-between mb-2">
        <a href="{{ url()->previous() }}"
           class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-white bg-gray-300 hover:bg-gray-500 px-4 py-2 rounded-lg transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
      </div>

      <div class="flex justify-between mb-2">
        <h2 class="text-black font-bold text-xl">Data Produk</h2>
      </div>


      @include('dashboard.stokist_report_detail._partials.table-product')

      <div class="flex justify-between mb-2">
        <h2 class="text-black font-bold text-xl">Data Pengiriman</h2>
      </div>

      @include('dashboard.stokist_report_detail._partials.table-deliver')

      <div class="flex justify-between mb-2">
        <h2 class="text-black font-bold text-xl">Data Transaksi</h2>
      </div>

      @include('dashboard.stokist_report_detail._partials.table-transactions')
  </div>
</x-layout>
