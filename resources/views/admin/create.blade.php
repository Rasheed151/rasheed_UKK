<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
<h2>Tambah Room Detail</h2>
<form action="{{ route('admin.store') }}" method="POST">
    @csrf
    <label>Type: <input type="text" name="type" required></label><br>
    <label>Price: <input type="number" name="price" required></label><br>
    <label>Capacity: <input type="number" name="capacity" required></label><br>
    <label>Bed: <input type="text" name="bed" required></label><br>
    <label>Detail (pisahkan dengan koma): <input type="text" name="detail" required></label><br>
    <button type="submit">Simpan</button>
</form>
</body>

</html>