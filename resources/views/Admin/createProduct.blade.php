@extends('layouts.app')

@section('contents')
<main id="main" class="main">
    <section class="section">
        <div class="card mb-3">
            <div class="card-body p-3">
                <div class="row gx-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-6 d-flex align-items-center">
                        <a href="#" class="mr-2">
                            <i class="ri-inbox-archive-fill fs-3"></i>
                        </a>
                        <h5 class="mb-0"><strong>Product Management</strong></h5>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('CreateProductProcess') }}" method="GET" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <select class="form-control" name="entri" aria-placeholder="pilih jumlah">
                                        <option value="10" {{ request('entri')=='10' ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ request('entri')=='25' ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('entri')=='50' ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('entri')=='100' ? 'selected' : '' }}>100</option>
                                        <option value="all" {{ request('entri')=='all' ? 'selected' : '' }}>Semua
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <input type="text" class="form-control" name="search" placeholder="search..."
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button type="submit" class="btn btn-success w-100"><i
                                            class="ri-search-eye-line"></i></button>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="hidden" name="reset_filter" id="reset_filter" value="0">
                                    <button type="submit" class="btn btn-danger w-100" onclick="resetFilter()"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Filter"><i
                                            class="ri-filter-off-line"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card ">
            <div class="card-body p-3">
                @if (session('Success'))
                <div class="alert alert-success">
                    {{ session('Success') }}
                </div>
                @endif

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
                                        <form action="{{ route('CreateProductProcess') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Product Name:</label>
                                                <input type="text" name="product_name" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Product Code:</label>
                                                <input type="text" name="product_code" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Product Category:</label>
                                                <select name="product_category" class="form-control">
                                                    <option value="makanan">Makanan</option>
                                                    <option value="minuman">Minuman</option>
                                                    <option value="cemilan">Cemilan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Product Price:</label>
                                                <input type="text" name="product_price" class="form-control" required>
                                            </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Create Product</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- End Basic Modal-->
                    </div>


                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-hover">
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
                                <td>
                                    <form action="{{ route('DeleteProduct', ['id' => $item->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none; background: none; cursor: pointer;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('EditProductView', ['id' => $item->id]) }}" style="margin-left: 10px; color:black">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
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
            </div>
        </div>
        </div>
        </div>
        </div>

        <script>
            function resetFilter() {
                document.getElementById('reset_filter').value = '1';
            }

            function deleteConfirmation(id, namaProduk) {
                Swal.fire({
                    title: 'Yakin hapus produk "' + namaProduk + '" ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    showClass: {
                        popup: 'animate__animated animate__fadeInUp animate__faster'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutDown animate__faster'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>

    </section>
</main>
