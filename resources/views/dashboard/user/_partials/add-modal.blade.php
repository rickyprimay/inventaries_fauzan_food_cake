<div id="add-user-modal" class="pt-12 hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50 backdrop-blur-sm">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="bg-white rounded-lg shadow-sm overflow-y-auto max-h-[80vh]">
          <div class="flex items-center justify-between p-4 border-b ">
              <h3 class="text-lg font-semibold text-gray-900">Tambah User</h3>
              <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-toggle="add-user-modal">&times;</button>
          </div>
          <form method="POST" action="{{ route('user.store') }}" class="p-4">
              @csrf
              <div class="grid gap-4 mb-4 grid-cols-2">
                  <div class="col-span-2">
                      <label for="name">Nama User</label>
                      <input type="text" name="name" id="name" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>
                  <div class="col-span-2">
                      <label for="username">Username</label>
                      <input type="text" name="username" id="username" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>
                  <div class="col-span-2">
                      <label for="password">Password</label>
                      <input type="password" name="password" id="password" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>
                  <div class="col-span-2">
                      <label for="password_confirmation">Konfirmasi Password</label>
                      <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>

                  <div class="col-span-2">
                      <label for="role">Role</label>
                      <select name="role_id" id="role_id" required class="w-full rounded-lg p-2.5 bg-gray-50">
                          <option value="">-- Pilih Role --</option>
                          @foreach ($roles as $role)
                              <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col-span-2">
                      <label for="outlet_id">Outlet</label>
                      <select name="outlet_id" id="outlet_id" required class="w-full rounded-lg p-2.5 bg-gray-50">
                          <option value="">-- Pilih Outlet --</option>
                          @foreach ($outlets as $outlet)
                              <option value="{{ $outlet->id }}">{{ $outlet->outlet_name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col-span-2">
                    <label for="division_id">Divisi</label>
                    <select name="division_id" id="division_id" required class="w-full rounded-lg p-2.5 bg-gray-50">
                        <option value="">-- Pilih Divisi --</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg px-5 py-2.5">Simpan</button>
          </form>
      </div>
  </div>
</div>
