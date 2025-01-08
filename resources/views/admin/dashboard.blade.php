<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Add Bootstrap or any CSS framework for styling -->
</head>
<body>
    <h1>Admin Dashboard</h1>
    
    <!-- Form to Add Transportation Record -->
    <form action="{{ route('transportation.store') }}" method="POST">
        @csrf
        <label for="name">Transportation Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="details">Details:</label>
        <textarea name="details" id="details" required></textarea>
        <button type="submit">Add Transportation</button>
    </form>

    <!-- Table to Display Transportation Records -->
    <h2>Transportation Records</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transportations as $transportation)
                <tr>
                    <td>{{ $transportation->id }}</td>
                    <td>{{ $transportation->name }}</td>
                    <td>{{ $transportation->details }}</td>
                    <td>
                        <!-- Update Button -->
                        <a href="{{ route('transportation.edit', $transportation->id) }}">Edit</a>
                        <!-- Delete Button -->
                        <form action="{{ route('transportation.destroy', $transportation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
