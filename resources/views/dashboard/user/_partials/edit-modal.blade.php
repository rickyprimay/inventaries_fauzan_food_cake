<div id="edit-user-modal-{{ $user->id }}" class="pt-12 hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50 backdrop-blur-sm">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="bg-white rounded-lg shadow-sm overflow-y-auto max-h-[80vh]">
          <div class="flex items-center justify-between p-4 border-b">
              <h3 class="text-lg font-semibold text-gray-900">Edit User</h3>
              <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-toggle="edit-user-modal-{{ $user->id }}">&times;</button>
          </div>
          <form method="POST" action="{{ route('user.update', $user->id) }}" class="p-4">
              @csrf
              @method('PUT')
              <div class="grid gap-4 mb-4 grid-cols-2">
                  <!-- Nama -->
                  <div class="col-span-2">
                      <label for="name">Nama User</label>
                      <input type="text" name="name" id="name" value="{{ $user->name }}" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>

                  <!-- Username -->
                  <div class="col-span-2">
                      <label for="username">Username</label>
                      <input type="text" name="username" id="username" value="{{ $user->username }}" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>

                  <!-- Role -->
                  <div class="col-span-2">
                      <label for="role_id">Role</label>
                      <select name="role_id" id="role_id" required class="w-full rounded-lg p-2.5 bg-gray-50">
                          @foreach ($roles as $role)
                              <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                  {{ $role->role_name }}
                              </option>
                          @endforeach
                      </select>
                  </div>

                  <!-- Outlet -->
                  <div class="col-span-2">
                      <label for="outlet_id">Outlet</label>
                      <select name="outlet_id" id="outlet_id" required class="w-full rounded-lg p-2.5 bg-gray-50">
                          <option value="">-- Pilih Outlet --</option>
                          @foreach ($outlets as $outlet)
                              <option value="{{ $outlet->id }}" {{ $user->outlet_id == $outlet->id ? 'selected' : '' }}>
                                  {{ $outlet->outlet_name }}
                              </option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col-span-2">
                      <label for="division_id">Divisi</label>
                      <select name="division_id" id="division_id" required class="w-full rounded-lg p-2.5 bg-gray-50">
                          <option value="">-- Pilih Divisi --</option>
                          @foreach ($divisions as $division)
                              <option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected' : '' }}>
                                  {{ $division->division_name }}
                              </option>
                          @endforeach
                      </select>
                  </div>
              </div>

              <div class="flex justify-between gap-2">
                  <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg px-5 py-2.5">Simpan Perubahan</button>
              </div>
          </form>
      </div>
  </div>
</div>
