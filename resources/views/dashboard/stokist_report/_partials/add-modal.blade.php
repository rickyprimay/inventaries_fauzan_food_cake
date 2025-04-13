<div id="add-stokist-modal" class="pt-12 hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50 backdrop-blur-sm">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="bg-white rounded-lg shadow-sm overflow-y-auto max-h-[80vh]">

          <div class="flex items-center justify-between p-4 border-b">
              <h3 class="text-lg font-semibold text-gray-900">Tambah Produk</h3>
              <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-toggle="add-stokist-modal">&times;</button>
          </div>

          <form action="{{ route('stokist-report.store') }}" method="POST" class="p-4">
              @csrf

              <div class="grid gap-4 mb-4">
                <div class="col-span-2">
                  <label for="date-range-picker" class="block mb-2 text-sm font-medium text-gray-900">
                    Rentang Tanggal
                  </label>
                  <div class="flex items-center">
                    <div class="relative w-full">
                      <input autocomplete="off" id="datepicker-range-start" name="report_date_start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tanggal mulai">
                    </div>
                    <span class="mx-2 text-gray-500">sampai</span>
                    <div class="relative w-full">
                      <input autocomplete="off" id="datepicker-range-end" name="report_date_end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tanggal selesai">
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="grid gap-4 mb-4">
                <div class="col-span-2">
                    <label for="report_type">Tipe Laporan</label>
                    <select name="report_type" id="report_type" required class="w-full rounded-lg p-2.5 bg-gray-50">
                        <option value="">-- Pilih Tipe Laporan --</option>
                          <option value="harian">Harian</option>
                          <option value="mingguan">Mingguan</option>
                          <option value="bulanan">Bulanan</option>
                          <option value="Tahunan">Tahunan</option>
                    </select>
                </div>
              </div>

              <div class="grid gap-4 mb-4">
                <div class="col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Laporan</label>
                    <textarea id="description" name="description" rows="4" class="w-full rounded-lg p-2.5 bg-gray-50" placeholder=""></textarea>                    
                </div>
              </div>

              <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg px-5 py-2.5">Simpan</button>
          </form>
      </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
      flatpickr("#datepicker-range-start", {
          dateFormat: "Y-m-d",
          allowInput: false,
      });
      flatpickr("#datepicker-range-end", {
          dateFormat: "Y-m-d",
          allowInput: false,
      });
  });
</script>
