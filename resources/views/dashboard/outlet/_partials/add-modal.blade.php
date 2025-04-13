<!-- Modal Tambah Outlet -->
<div id="add-outlet-modal" class="pt-12 hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50 backdrop-blur-sm">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="bg-white rounded-lg shadow-sm overflow-y-auto max-h-[80vh]">
          <!-- Modal Header -->
          <div class="flex items-center justify-between p-4 border-b">
              <h3 class="text-lg font-semibold text-gray-900">Tambah Outlet</h3>
              <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-toggle="add-outlet-modal">&times;</button>
          </div>

          <!-- Modal Body -->
          <form action="{{ route('outlet.store') }}" method="POST" class="p-4">
              @csrf
              <div class="grid gap-4 mb-4">
                  <div class="col-span-2">
                      <label for="outlet_name">Nama Outlet</label>
                      <input type="text" name="outlet_name" id="outlet_name" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>
                  
                  <div class="col-span-2">
                    <label for="outlet_address">Alamat Outlet</label>
                    <input type="text" name="outlet_address" id="outlet_address" required class="w-full rounded-lg p-2.5 bg-gray-50">
                </div>

                <div class="col-span-2">
                  <label for="city">Kota Outlet</label>
                  <input type="text" name="city" id="city" required class="w-full rounded-lg p-2.5 bg-gray-50">
              </div>

                <div class="col-span-2">
                  <label for="is_central_kitchen">Central Kitchen</label>
                  <select name="is_central_kitchen" id="is_central_kitchen" required class="w-full rounded-lg p-2.5 bg-gray-50">
                      <option value="">-- Pilih --</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                  </select>
              </div>
              </div>

              <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg px-5 py-2.5">Simpan</button>
          </form>
      </div>
  </div>
</div>