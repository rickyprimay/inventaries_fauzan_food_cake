<div id="edit-product-modal-{{ $product->id }}" class="pt-12 hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50 backdrop-blur-sm">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="bg-white rounded-lg shadow-sm overflow-y-auto max-h-[80vh]">

          <div class="flex items-center justify-between p-4 border-b">
              <h3 class="text-lg font-semibold text-gray-900">Edit Produk</h3>
              <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-toggle="edit-product-modal-{{ $product->id }}">&times;</button>
          </div>

          <form action="{{ route('product.update', $product->id) }}" method="POST" class="p-4">
              @csrf
              @method('PUT')
              <div class="grid gap-4 mb-4">
                  <div class="col-span-2">
                      <label for="product">Nama Produk</label>
                      <input type="text" value="{{ $product->product_name }}" name="product_name" id="product_name" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>
              </div>

              <div class="grid gap-4 mb-4">
                <div class="col-span-2">
                  <label for="datepicker-autohide" class="block mb-2 text-sm font-medium text-gray-900">
                    Tanggal Input
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
                      value="{{ \Carbon\Carbon::parse($product->date_input)->format('Y-m-d') }}"
                      id="send_date"
                      name="date_input"
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
                    <label for="category">Kategori</label>
                    <select name="id_category" id="id_category" required class="w-full rounded-lg p-2.5 bg-gray-50">
                      <option value="">-- Pilih Kategori --</option>
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}"
                              {{ $product->id_category == $category->id ? 'selected' : '' }}>
                              {{ $category->category_name }}
                          </option>
                      @endforeach
                  </select>
                </div>
              </div>
              
              <div class="grid gap-4 mb-4">
                  <div class="col-span-2">
                      <label for="unit">Satuan (Kg, Gram, Liter, dll)</label>
                      <input value="{{ $product->unit }}" type="text" name="unit" id="unit" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>
              </div>

              <div class="grid gap-4 mb-4">
                  <div class="col-span-2">
                      <label for="stock">Stock Barang</label>
                      <input value="{{ $product->stock }}" type="number" name="stock" id="stock" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>
              </div>

              <div class="grid gap-4 mb-4">
                  <div class="col-span-2">
                      <label for="price">Harga Barang</label>
                      <input value="{{ $product->price }}" type="number" name="price" id="price" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>
              </div>

              <div class="grid gap-4 mb-4">
                <div class="col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Produk</label>
                    <textarea id="description" name="description" rows="4" class="w-full rounded-lg p-2.5 bg-gray-50" placeholder="">{{ $product->description }}</textarea>                    
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
  });
</script>