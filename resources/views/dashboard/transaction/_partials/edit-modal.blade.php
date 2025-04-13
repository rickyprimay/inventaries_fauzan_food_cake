<div id="edit-transaction-modal-{{ $transaction->id }}" class="pt-12 hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50 backdrop-blur-sm">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="bg-white rounded-lg shadow-sm overflow-y-auto max-h-[80vh]">

          <div class="flex items-center justify-between p-4 border-b">
              <h3 class="text-lg font-semibold text-gray-900">Edit Transaksi</h3>
              <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-toggle="edit-transaction-modal-{{ $transaction->id }}">&times;</button>
          </div>

          <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="p-4">
              @csrf
              @method('PUT')

              <div class="grid gap-4 mb-4">
                <div class="col-span-2">
                    <label for="product_id">Product</label>
                    <select name="product_id" id="product_id" required class="w-full rounded-lg p-2.5 bg-gray-50">
                        <option value="">-- Pilih Product --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $product->id == $transaction->product_id ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
              </div>

              <div class="grid gap-4 mb-4">
                <div class="col-span-2">
                    <label for="transactions_type">Tipe Transaksi</label>
                    <select name="transactions_type" id="transactions_type" required class="w-full rounded-lg p-2.5 bg-gray-50">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="masuk" {{ $transaction->transactions_type == 'masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="keluar" {{ $transaction->transactions_type == 'keluar' ? 'selected' : '' }}>Keluar</option>
                        <option value="retur" {{ $transaction->transactions_type == 'retur' ? 'selected' : '' }}>Retur</option>
                        <option value="waste" {{ $transaction->transactions_type == 'waste' ? 'selected' : '' }}>Waste</option>
                    </select>
                </div>
              </div>

              <div class="grid gap-4 mb-4">
                  <div class="col-span-2">
                      <label for="quantity">Quantity</label>
                      <input type="number" name="quantity" id="quantity" required class="w-full rounded-lg p-2.5 bg-gray-50" value="{{ $transaction->quantity }}">
                  </div>
              </div>

              <div class="grid gap-4 mb-4">
                <div class="col-span-2">
                  <label for="datepicker-edit-{{ $transaction->id }}" class="block mb-2 text-sm font-medium text-gray-900">
                    Tanggal Transaksi
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                      <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                          d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                      </svg>
                    </div>
                      <input
                        autocomplete="off"
                        value="{{ $transaction->date }}"
                        id="send_date"
                        name="date"
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
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Transaksi</label>
                    <textarea id="description" name="description" rows="4" class="w-full rounded-lg p-2.5 bg-gray-50">{{ $transaction->description }}</textarea>                    
                </div>
              </div>

              <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg px-5 py-2.5">Simpan</button>
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
  });
</script>
