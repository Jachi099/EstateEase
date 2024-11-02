<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=1440, maximum-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('admin_css/profileu95admin.css') }}">
  </head>
  <body>
    <div class="container">
      <h1>Edit Profile</h1>

      <!-- Display success message -->
      @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
      @endif

      <!-- Display validation errors -->
      @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <!-- Profile Edit Form -->
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Full Name:</label>
        <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

        <label>Password:</label>
        <input type="password" name="password" placeholder="Leave blank to keep current password">

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation">

        <label>Profile Picture:</label>
        <input type="file" name="profile_picture">

        <button type="submit">Update Profile</button>
      </form>

      <!-- Delete Profile Form -->
      <form action="{{ route('profile.delete') }}" method="POST">
        @csrf
        <button type="submit">Delete Profile</button>
      </form>
    </div>
  </body>
</html>
