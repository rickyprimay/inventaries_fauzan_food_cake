<div id="edit-delivery-modal-{{ $delivery->id }}" class="pt-12 hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50 backdrop-blur-sm">
  <div class="relative p-4 w-full max-w-md max-h-full">
    <div class="bg-white rounded-lg shadow-sm overflow-y-auto max-h-[80vh]">
      <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Pengiriman</h3>
        <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-toggle="edit-delivery-modal-{{ $delivery->id }}">&times;</button>
      </div>

      <form action="{{ route('delivery.update', $delivery->id) }}" method="POST" class="p-4">
        @csrf
        @method('PUT')

        <div class="grid gap-4 mb-4">
          <div class="col-span-2">
            <label for="to_outlet_id">Ke Outlet</label>
            <select name="to_outlet_id" id="to_outlet_id_edit_{{ $delivery->id }}" required class="w-full rounded-lg p-2.5 bg-gray-50">
              <option value="">-- Pilih Outlet --</option>
              @foreach ($outlets as $outlet)
                <option value="{{ $outlet->id }}" {{ $delivery->to_outlet_id == $outlet->id ? 'selected' : '' }}>
                  {{ $outlet->outlet_name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="grid gap-4 mb-4">
          <div class="col-span-2">
            <label for="datepicker-autohide-edit" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Kirim</label>
            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div>
                <input
                  id="send_date"
                  autocomplete="off"
                  value="{{ $delivery->send_date }}"
                  name="send_date"
                  type="text"
                  required
                  placeholder="Pilih tanggal"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 flatpickr"
                >
            </div>
          </div>
        </div>

        <div class="grid gap-4 mb-4">
          <div class="col-span-2">
            <label for="send_status">Status Pengiriman</label>
            <select name="send_status" id="send_status" required class="w-full rounded-lg p-2.5 bg-gray-50">
              <option value="">-- Pilih Status --</option>
              <option value="pending" {{ $delivery->send_status == 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="dikirim" {{ $delivery->send_status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
            </select>
          </div>
        </div>

        <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg px-5 py-2.5">Simpan Perubahan</button>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    flatpickr(".flatpickr", {
      dateFormat: "Y-m-d",
      altInput: true,
      altFormat: "d F Y",
      allowInput: true
    });
    const toSelect = document.getElementById("to_outlet_id_edit_{{ $delivery->id }}");

    if (fromSelect && toSelect) {
      fromSelect.addEventListener("change", function () {
        const selectedFrom = this.value;

        Array.from(toSelect.options).forEach(option => {
          option.disabled = false;
        });

        if (selectedFrom) {
          Array.from(toSelect.options).forEach(option => {
            if (option.value === selectedFrom) {
              option.disabled = true;
              if (toSelect.value === selectedFrom) {
                toSelect.value = '';
              }
            }
          });
        }
      });

      const selectedFrom = fromSelect.value;
      Array.from(toSelect.options).forEach(option => {
        option.disabled = option.value === selectedFrom;
      });
    }
  });
</script>
