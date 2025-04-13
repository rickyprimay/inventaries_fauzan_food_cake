<div class="max-w-full overflow-x-auto">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Nama</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Username</th>
              <th class="min-w-[120px] px-4 py-4 font-medium text-black">Role</th>
              <th class="min-w-[120px] px-4 py-4 font-medium text-black">Outlet</th>
              <th class="min-w-[120px] px-4 py-4 font-medium text-black">Divisi</th>
              <th class="px-4 py-4 font-medium text-black">Aksi</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($users as $user)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="border-b text-black px-4 py-5">{{ $user->name }}</td>
                  <td class="border-b text-black px-4 py-5">{{ $user->username }}</td>
                  <td class="border-b text-black px-4 py-5">{{ $user->role->role_name }}</td>
                  <td class="border-b text-black px-4 py-5">{{ $user->outlet->outlet_name ?? '-' }}</td>
                  <td class="border-b text-black px-4 py-5">{{ $user->division->division_name ?? '-' }}</td>
                  <td class="border-b text-black px-4 py-5">
                      <div class="flex items-center space-x-3.5">
                          <button data-modal-target="edit-user-modal-{{ $user->id }}" data-modal-toggle="edit-user-modal-{{ $user->id }}">
                              <i class="fa-solid fa-pencil text-blue-500"></i>
                          </button>
                          <button data-modal-target="user-delete-modal-{{ $user->id }}" data-modal-toggle="user-delete-modal-{{ $user->id }}">
                              <i class="fas fa-trash-alt text-red-500"></i>
                          </button>
                      </div>
                  </td>
              </tr>
              @include('dashboard.user._partials.delete-modal', ['user' => $user])
          @empty
              <tr>
                  <td colspan="6" class="text-center px-4 py-5 text-gray-500">Tidak ada user.</td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $users->links('pagination::tailwind') }}
</div>
