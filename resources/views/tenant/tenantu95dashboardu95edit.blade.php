<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=1440, maximum-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('tenant-css/tenantu95dashboardu95edit.css') }}">
  </head>
  <body>
    <div class="container">
      <h1>Tenant Dashboard</h1>

      <!-- Success message -->
      @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
      @endif

      <!-- Validation errors -->
      @if ($errors->any())
        <div style="color: red;">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Profile Update Form -->
      <form action="{{ route('tenant.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Full Name:</label>
        <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>

        <label>Current Address:</label>
        <input type="text" name="address" value="{{ old('address', $user->address) }}">

        <label>Phone Number:</label>
        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">

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

      <a href="{{ url('/tenant/dashboard') }}">Go Back</a>
    </div>
  </body>
</html>
