<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Medicine</title>
</head>
<body>
    <h1>Create Medicine</h1>
    <form action="{{ route('medicines.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Medicine Name:</label>
        <input type="text" name="name" required><br>

        <label for="price">Price:</label>
        <input type="number" name="price" required step="0.01"><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*" required><br>

        <button type="submit">Create Medicine</button>
    </form>
</body>
</html>