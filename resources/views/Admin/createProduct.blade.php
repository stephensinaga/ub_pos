<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Create Product</title>
</head>

<body>
    @if (session('Success'))
        <div class="alert alert-success">
            {{ session('Success') }}
        </div>
    @endif

    <form action="{{ route('CreateProductProcess') }}" method="post">
        @csrf
        <label for="">Product Name:</label>
        <input type="text" name="product_name" required id=""><br>
        <label for="">Product Code:</label>
        <input type="text" name="product_code" required id=""><br>
        <label for="">Product Category:</label>
        <select name="product_category" id="">
            <option value="makanan">Makanan</option>
            <option value="minuman">Minuman</option>
            <option value="cemilan">Cemilan</option>
        </select><br>
        <label for="">Product Price</label>
        <input type="text" name="product_price" required id=""><br>
        <button type="submit">Create Product</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Category</th>
                <th>Price</th>
                <th>Actionn</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($data))
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->product_code }}</td>
                        <td>{{ $item->product_category }}</td>
                        <td>{{ $item->product_price }}</td>
                        <td>
                            <form action="{{ route('DeleteProduct', ['id' => $item->id]) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none; cursor: pointer;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{ route('EditProductView', ['id' => $item->id]) }}"><i
                                    class="fa-solid fa-file-pen"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

</body>

</html>
