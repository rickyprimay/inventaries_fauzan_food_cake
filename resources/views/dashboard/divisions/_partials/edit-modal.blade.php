<!-- Modal Edit Divisi -->
<div id="edit-division-modal-{{ $division->id }}" class="pt-12 hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="rounded-lg shadow-sm bg-white overflow-y-auto max-h-[80vh]">
  
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Edit Divisi</h3>
                <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-toggle="edit-division-modal-{{ $division->id }}">&times;</button>
            </div>
  
            <!-- Form -->
            <form action="{{ route('division.update', $division->id) }}" method="POST" class="p-4">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4">
                    <div class="col-span-2">
                        <label for="division_name_{{ $division->id }}" class="block mb-1 text-sm font-medium text-gray-900">Nama Divisi</label>
                        <input type="text" name="division_name" id="division_name_{{ $division->id }}" required
                            value="{{ $division->division_name }}"
                            class="w-full rounded-lg p-2.5 bg-gray-50 text-gray-900">
                    </div>
                </div>
  
                <button type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg px-5 py-2.5">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
  </div>
  