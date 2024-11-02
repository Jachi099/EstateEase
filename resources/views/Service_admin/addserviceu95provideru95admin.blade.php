<!DOCTYPE html>
<html>
<head>
    <title>Add Service Provider</title>
    <link rel="stylesheet" href="{{ asset('sevice_admin_css/addserviceu95provideru95admin.css') }}">
</head>
<body>
    <form action="{{ route('service-providers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Full Name:</label>
        <input type="text" name="full_name" required>

        <label>Service Type:</label>
        <input type="text" name="service_type" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Phone Number:</label>
        <input type="text" name="phone_number" required>

        <label>Service Area:</label>
        <input type="text" name="service_area" required>

        <label>Experience:</label>
        <input type="text" name="experience" required>

        <label>Profile Picture:</label>
        <input type="file" name="profile_picture">

        <button type="submit">Add Service Provider</button>
    </form>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
</body>
</html>
