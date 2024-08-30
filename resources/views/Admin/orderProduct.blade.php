<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Product</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container">
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-hover" id="datatables">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data))
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->product_code }}</td>
                        <td>{{ $item->product_category }}</td>
                        <td>{{ number_format($item->product_price, 0, ',', '.') }}</td>
                        <td class="order-action">
                            <form action="javascript:void(0)" method="POST" class="AddOrder" data-id="{{ $item->id }}">
                                @csrf
                                @method('post')
                                <button type="submit" class="order-btn">
                                    Order
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="form-checkout">
            <form action="javascript:void(0)" method="put" id="FormCheckOut">
                @csrf
                @method('PUT')
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover" id="datatables">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($order))
                            @foreach ($order as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_code }}</td>
                                <td>{{ $item->product_category }}</td>
                                <td>{{ number_format($item->product_price, 0, ',', '.') }}</td>
                                <td><input type="number" name="order_qty" id=""></td>
                                <td>
                                    <form action="{{ route('DeletePendingProduct', ['id' => $item->id]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none; background: none; cursor: pointer;">
                                            <i class="bi bi-trash"></i>D
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center">Belum ada Pesanan</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="submit">Checkout</button>
                </div>

            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('#datatables').DataTable();

        $('#datatables').on('submit', '.AddOrder', function(event) {
            event.preventDefault();

            var form = $(this);
            var productId = form.data('id');

            jQuery.ajax({
                url: "/admin/order/product/" + productId,
                data: form.serialize(),
                type: 'POST',
                success: function(result) {
                    form[0].reset();
                    alert('Berhasil TOD, Semangat dong 🫵');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Gagal menambahkan data');
                }
            });
        });

        $('#datatables').on('submit', 'form[action*="DeletePendingProduct"]', function(event) {
        event.preventDefault();
        var form = $(this);

        jQuery.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(result) {
                alert('Produk berhasil dihapus');
                dataTable.row(form.closest('tr')).remove().draw(); // Hapus baris dari tabel
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert('Gagal menghapus data');
            }
        });
    });

    });
</script>

</html>
