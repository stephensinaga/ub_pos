<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>
</head>

<body>
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
</body>

</html>
