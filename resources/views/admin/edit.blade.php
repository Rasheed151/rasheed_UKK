<h2>Edit Room Detail</h2>
<form action="{{ route('admin.update', $room_detail['id']) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Type: <input type="text" name="type" value="{{ $room_detail['type'] }}" required></label><br>
    <label>Price: <input type="number" name="price" value="{{ $room_detail['price'] }}" required></label><br>
    <label>Capacity: <input type="number" name="capacity" value="{{ $room_detail['capacity'] }}" required></label><br>
    <label>Bed: <input type="text" name="bed" value="{{ $room_detail['bed'] }}" required></label><br>
    <label>Detail (pisahkan dengan koma): <input type="text" name="detail" value="{{ implode(',', $room_detail['detail']) }}" required></label><br>
    <button type="submit">Update</button>
</form>

