<div class="max-w-full overflow-x-auto">
  <table class="w-full table-auto">
      <thead>
          <tr class="bg-gray-400 text-left">
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">No</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Nama Outlet</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Alamat Outlet</th>
              <th class="min-w-[150px] px-4 py-4 font-medium text-black">Kota Outlet</th>
              <th class="min-w-[120px] px-4 py-4 font-medium text-black">Central Kitchen</th>
              <th class="px-4 py-4 font-medium text-black">Aksi</th>
          </tr>
      </thead>
      <tbody>
          @forelse ($outlets as $outlet)
              <tr>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ ($outlets->currentPage() - 1) * $outlets->perPage() + $loop->iteration }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $outlet->outlet_name }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $outlet->outlet_address }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $outlet->city }}</p>
                  </td>
                  <td class="border-b px-4 py-5">
                      <p class="text-black">{{ $outlet->is_central_kitchen == 1 ? 'Ya' : 'Tidak' }}</p>
                  </td>
                  </td>
                  <td class="border-b px-4 py-5">
                      <div class="flex items-center space-x-3.5">
                        <button data-modal-target="edit-outlet-modal-{{ $outlet->id }}" data-modal-toggle="edit-outlet-modal-{{ $outlet->id }}" class="hover:text-primary" >
                            <i class="fa-solid fa-pencil text-blue-500"></i>
                        </button>
                          <button data-modal-target="outlet-delete-modal-{{ $outlet->id }}" data-modal-toggle="outlet-delete-modal-{{ $outlet->id }}" class="hover:text-primary">
                              <i class="fas fa-trash-alt text-red-500"></i>
                          </button>
                      </div>
                  </td>
              </tr>
              @include('dashboard.outlet._partials.delete-modal', ['outlet' => $outlet])
          @empty
              <tr>
                  <td colspan="6" class="text-center px-4 py-5 text-gray-500">
                      Tidak ada outlet.
                  </td>
              </tr>
          @endforelse
      </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $outlets->links() }}
</div>
