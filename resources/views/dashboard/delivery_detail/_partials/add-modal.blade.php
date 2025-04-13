<div id="add-delivery-modal" class="pt-12 hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen bg-black bg-opacity-50 backdrop-blur-sm">
  <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="bg-white rounded-lg shadow-sm overflow-y-auto max-h-[80vh]">

          <div class="flex items-center justify-between p-4 border-b">
              <h3 class="text-lg font-semibold text-gray-900">Tambah Barang</h3>
              <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-toggle="add-delivery-modal">&times;</button>
          </div>

          <form action="{{ route('delivery.detail.store') }}" method="POST" class="p-4">
              @csrf

              <input type="hidden" value="{{ $delivery->id }}" name="delivery_id">

              <div class="grid gap-4 mb-4">
                <div class="col-span-2">
                    <label for="product_id">Dari Outlet</label>
                    <select name="product_id" id="product_id" required class="w-full rounded-lg p-2.5 bg-gray-50">
                        <option value="">-- Pilih Product --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              
              <div class="grid gap-4 mb-4">
                  <div class="col-span-2">
                      <label for="qty">Quantity</label>
                      <input type="number" name="quantity" id="quantity" required class="w-full rounded-lg p-2.5 bg-gray-50">
                  </div>
              </div>

              <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-medium rounded-lg px-5 py-2.5">Simpan</button>
          </form>
      </div>
  </div>
</div>
  