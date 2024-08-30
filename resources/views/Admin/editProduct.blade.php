<div class="justify-content-start">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#basicModal">
        Tambah menu
    </button>
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('EditProductProcess', ['id' => $item->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <label for="">Product Name:</label>
                        <input type="text" name="product_name" value="{{ $item->product_name }}" required id=""><br>
                        <label for="">Product Code:</label>
                        <input type="text" name="product_code" value="{{ $item->product_code }}" required id=""><br>
                        <label for="">Product Category:</label>
                        <select name="product_category" id="">
                            <option value="makanan" {{ $item->product_category == 'makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="minuman" {{ $item->product_category == 'minuman' ? 'selected' : '' }}>Minuman</option>
                            <option value="cemilan" {{ $item->product_category == 'cemilan' ? 'selected' : '' }}>Cemilan</option>
                        </select><br>
                        <label for="">Product Price</label>
                        <input type="text" name="product_price" value="{{ $item->product_price }}" required id=""><br>
                        <button type="submit">Update Product</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- End Basic Modal-->
</div>
