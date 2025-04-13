<div class="max-w-full overflow-x-auto">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Outlet</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Divisi</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Rentang Laporan</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Tipe Laporan</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Dibuat Oleh</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Deskripsi</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Dibuat pada</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Detail Laporan</th>
              <th class="px-4 py-4 font-medium text-black">Aksi</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($stokistReports as $stokistReport)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ ($stokistReports->currentPage() - 1) * $stokistReports->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $stokistReport->outlets->outlet_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $stokistReport->divisions->division_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ \Carbon\Carbon::parse($stokistReport->report_date_start)->translatedFormat('j M Y') }} - {{ \Carbon\Carbon::parse($stokistReport->report_date_end)->translatedFormat('j M Y') }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ ucfirst($stokistReport->report_type) }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $stokistReport->user->name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black truncate max-w-[200px] cursor-pointer hover:text-blue-500"
                         data-modal-target="desc-modal-{{ $stokistReport->id }}"
                         data-modal-toggle="desc-modal-{{ $stokistReport->id }}">
                         {{ text_limiter($stokistReport->description) }}
                      </p>
                  </td>    
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ \Carbon\Carbon::parse($stokistReport->created_at)->format('H:i d M Y') }}</p>
                  </td>      
                  <td class="border-b px-4 py-5">
                      <a href="{{ route('stokist-report.detail', $stokistReport->id) }}" class="text-black hover:text-yellow-500"><i class="fa-solid fa-eye"></i> Lihat Detail Laporan</a>
                  </td>      
                  @if ($isAdmin == true || $isPIC == true)
                    <td class="border-b px-4 py-5">
                        <div class="flex items-center space-x-3.5">
                              <button data-modal-target="stokistReport-delete-modal-{{ $stokistReport->id }}" data-modal-toggle="stokistReport-delete-modal-{{ $stokistReport->id }}" class="hover:text-primary">
                                  <i class="fas fa-trash-alt text-red-500"></i>
                              </button>
                        </div>
                    </td>
                  @endif
              </tr>
              <div id="desc-modal-{{ $stokistReport->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow">
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                      <h3 class="text-xl font-semibold text-gray-900">
                        Deskripsi Laporan
                      </h3>
                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="desc-modal-{{ $stokistReport->id }}">
                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 0 1 1.414 0L10 8.586l4.293-4.293a1 1 0 1 1 1.414 1.414L11.414 10l4.293 4.293a1 1 0 1 1-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 0 1-1.414-1.414L8.586 10 4.293 5.707a1 1 0 0 1 0-1.414z" clip-rule="evenodd"/></svg>
                      </button>
                    </div>
                    <div class="p-6 space-y-6">
                      <p class="text-base leading-relaxed text-gray-500">
                        {{ $stokistReport->description }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              @include('dashboard.stokist_report._partials.delete-modal', ['stokistReport' => $stokistReport])
          @empty
              <tr>
                  <td colspan="9" class="text-center px-4 py-5 text-gray-500">
                      Tidak ada Laporan Stokist.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $stokistReports->links() }}
</div>
