<div class="max-w-full overflow-x-auto">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Nama divisi</th>
              <th class="px-4 py-4 font-medium text-black">Aksi</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($divisions as $division)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ ($divisions->currentPage() - 1) * $divisions->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5 ">
                      <p class="text-black">{{ $division->division_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5 ">
                      <div class="flex items-center space-x-3.5">
                        <button data-modal-target="edit-division-modal-{{ $division->id }}" data-modal-toggle="edit-division-modal-{{ $division->id }}" class="hover:text-primary" >
                            <i class="fa-solid fa-pencil text-blue-500"></i>
                        </button>
                          <button data-modal-target="division-delete-modal-{{ $division->id }}" data-modal-toggle="division-delete-modal-{{ $division->id }}" class="hover:text-primary">
                              <i class="fas fa-trash-alt text-red-500"></i>
                          </button>
                      </div>
                  </td>
              </tr>
              @include('dashboard.divisions._partials.delete-modal', ['division' => $division])
          @empty
              <tr>
                  <td colspan="6" class="text-center px-4 py-5 text-gray-500">
                      Tidak ada divisi.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $divisions->links() }}
</div>
