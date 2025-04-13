<x-layout>
    <div class="p-8">
        <div class="flex justify-between mb-2">
            <h1 class="text-black font-bold text-2xl">Detail Pengiriman dari
                {{ $delivery->fromOutlet->outlet_name ?? '-' }} ke {{ $delivery->toOutlet->outlet_name ?? '-' }} </h1>
            @if ($isFromOutletId == true)
              <button data-modal-target="add-delivery-modal" data-modal-toggle="add-delivery-modal" type="button"
                  class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                  Tambah Barang
              </button>
            @endif
        </div>

        <div class="flex justify-start">
            <h2 class="text-black font-bold text-xl mb-4">Status Pengiriman: @php
                $statusClass = match ($delivery->send_status) {
                    'diterima' => 'bg-success bg-opacity-10 text-success',
                    'pending' => 'bg-danger bg-opacity-10 text-danger',
                    'dikirim' => 'bg-warning bg-opacity-10 text-warning',
                    default => 'bg-gray-200 text-gray-700',
                };
            @endphp
                <p class="inline-flex rounded-full px-3 py-1 text-sm font-medium {{ $statusClass }}">
                    {{ ucfirst($delivery->send_status) }}
                </p>
            </h2>
        </div>

        <div class="flex justify-between mb-2">
          <a href="{{ url()->previous() }}"
             class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-white bg-gray-300 hover:bg-gray-500 px-4 py-2 rounded-lg transition">
              <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
          </a>

          <h2 class="text-black font-bold text-xl mb-4">Dikirim pada: {{ \Carbon\Carbon::parse($delivery->send_date)->translatedFormat('j M Y') }}</h2>
      </div>

      @include('dashboard.delivery_detail._partials.table')

      @include('dashboard.delivery_detail._partials.add-modal')
      @foreach ($detailDeliveries as $delivery)
        @include('dashboard.delivery_detail._partials.edit-modal')
      @endforeach
    </div>
</x-layout>
